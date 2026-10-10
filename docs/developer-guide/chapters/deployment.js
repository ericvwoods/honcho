// ============================================================
// chapters/deployment.js — Deployment chapter of the Honcho Developer's Guide
// ============================================================
// Part III: Installation & Configuration. Started 2026-10-08 while
// standing up BPA's first DigitalOcean droplet; the step list matches
// the DO-xx cards on the Honcho Dev Board. Update it as each step is done.
// Same block format and inline markup as chapters/ccmps.js.
// ============================================================

const sections = [

// ============================================================
{ tab: "Hosting Model", blocks: [
  { type: 'p', text: "Honcho is hosted on **DigitalOcean**. Each client gets **one droplet** that runs both its **production** and its **staging/UAT** copy of Honcho, plus Hermes (the AI agent) for that client. Small clients may later share a droplet under a shared domain; large clients get their own droplet and their own domain." },

  { type: 'h2', text: 'Two Environments on One Droplet' },
  { type: 'table', headers: ['Piece', 'Production', 'Staging / UAT'], rows: [
    ['Web address', '`members.bpapilots.org`', '`uat.bpapilots.org`'],
    ['Member login', '`https://members.bpapilots.org/`', '`https://uat.bpapilots.org/`'],
    ['Staff (Honcho) login', '`https://members.bpapilots.org/honcho`', '`https://uat.bpapilots.org/honcho`'],
    ['App container', '`honcho-prod`', '`honcho-staging`'],
    ['Database', '`bpa_prod`, its own database user', '`bpa_staging`, its own database user'],
    ['Hermes', 'Production profile; sends to real recipients', 'Staging profile; reads `bpa_staging`, sends only to a test address'],
  ]},
  { type: 'p', text: "One MariaDB container holds both databases. Caddy is the only service open to the internet; it gets the HTTPS certificates and sends each web address to the right app container. The database publishes no port." },
  { type: 'alert', variant: 'info', text: "**Subdomains are not registered.** Whoever controls a domain's DNS creates a subdomain by adding an A record pointing at the droplet's IP. Add the records only once the server is locked down." },
  { type: 'alert', variant: 'warning', text: "**A domain may have only one SPF record.** When adding Brevo's SPF for bpapilots.org, merge it into the existing record. Two SPF records break email for the whole domain." },

  { type: 'h2', text: 'Releases' },
  { type: 'p', text: "Code moves from staging to production; **data never does** (staging data is a test copy)." },
  { type: 'ol', items: [
    "Tag the git commit that passed UAT on staging.",
    "Back up `bpa_prod`.",
    "Deploy the same tag to the production stack and run any SQL change scripts against `bpa_prod`.",
    "To roll back: redeploy the previous tag and restore the backup.",
  ]},
  { type: 'p', text: "The first go-live is different: the droplet starts as staging only, and at cutover the legacy site's database and uploads are imported into `bpa_prod`. The legacy host (which also serves the old UAT at `bpauat.bpapilots.org`) is kept for two weeks as a fallback." },
]},

// ============================================================
{ tab: "BPA Droplet", blocks: [
  { type: 'p', text: "Created 2026-10-08. This is BPA's droplet; it runs staging only until go-live." },
  { type: 'table', headers: ['Setting', 'Value', 'Notes'], rows: [
    ['Name', '`bpa-honcho-01`', ''],
    ['Public IPv4', '`159.223.185.25`', 'IPv6 off for now (one fewer thing to firewall).'],
    ['Region', 'New York, NYC1', 'In the `default-nyc1` VPC (private network).'],
    ['Image', 'Ubuntu 24.04 (LTS) x64', ''],
    ['Plan', 'Basic, Premium AMD: 2 vCPU, 4 GB RAM, 80 GB NVMe SSD, 4 TB transfer', '$28/mo. Resize to 8 GB ($42/mo) before go-live, when production joins staging. Choose "CPU and RAM only" when resizing so it can be sized down again.'],
    ['Backups', 'Daily, kept 7 days; window 11pm–3am Central', 'About 30% of the droplet price. Our own nightly off-droplet database backups come later (DO-18).'],
    ['Monitoring', 'On (DigitalOcean metrics agent)', 'Needed for alerts (DO-19).'],
    ['Authentication', 'SSH key only (`macbook2018`, ED25519)', 'No password login.'],
    ['Managed Database', 'Not used', 'MariaDB runs in a container on the droplet (decision card DO-W6).'],
    ['Tags', '`bpa`, `honcho`', 'Lets a Cloud Firewall attach by tag.'],
  ]},

  { type: 'h2', text: 'Versions to Match' },
  { type: 'p', text: "Taken from the XAMPP install the code was developed on, so the server behaves the same:" },
  { type: 'table', headers: ['Component', 'Local (XAMPP)', 'Droplet'], rows: [
    ['PHP', '8.2.4', '`php:8.2-apache` image, with mysqli, pdo_mysql, mbstring, gd, intl, zip and mod_rewrite'],
    ['Database', 'MariaDB 10.4.28', '`mariadb:10.11` (see the Compose Stack tab)'],
  ]},
  { type: 'p', text: "The only hard-coded address in the code was `BASE_URL` (`http://localhost/bpausa/` locally); it now comes from each environment's `.env` file (see the Code & Settings tab)." },
]},

// ============================================================
{ tab: "Code & Settings", blocks: [
  { type: 'p', text: "The code lives in the private GitHub repository `github.com/ericvwoods/honcho` (branch `main`). The server gets the code from there, never by copying files from the Mac." },
  { type: 'h2', text: 'What Is Not in Git' },
  { type: 'p', text: "`.gitignore` keeps out: `.env`, database dumps (`ccmps.sql`, `ccmps_aux.sql`), user uploads (DMS and CMS library files, `public/uploads`, member photos in `modules/<module>/assets/<record id>/`), Inspinia's unused `Utils/` folder and zip, and backup copies (`* copy.php`, `*_old.php`, `*.last`, `legacy views/`, ...). Uploads and data reach the server separately (DO-06)." },
  { type: 'h2', text: 'The .env File' },
  { type: 'p', text: "Secrets and anything that differs between installs live in `.env` in the project root. It is **never committed**; `.env.example` (committed) lists every setting with no real values. `config/env.php` reads it and provides `env('NAME', default)`; `config/config.php` and `config/database.php` use that. A real environment variable (as Docker passes them) wins over the file." },
  { type: 'table', headers: ['Setting', 'Used for'], rows: [
    ['`BASE_URL`', 'The site address, with a trailing slash'],
    ['`WHATENV`', '`dev`, `uat` or `prod`'],
    ['`JWT_SECRET`', 'Signs mobile-app login tokens. Make one per install with `openssl rand -hex 32`'],
    ['`DB_HOST`, `DB_PORT`, `DB_USER`, `DB_PASSWORD`, `DB_DATABASE`', 'Database connection'],
    ['`BREVO_SMTP_KEY`, `BREVO_API_KEY`, `SYNC_BREVO`', 'Email through Brevo; `SYNC_BREVO=1` syncs contacts'],
  ]},
  { type: 'h2', text: 'The Docker Image' },
  { type: 'p', text: "`Dockerfile` (project root) builds the web app image: `php:8.2-apache` plus the `mysqli`, `pdo_mysql`, `gd` and `zip` extensions (mbstring, fileinfo, xml and curl come with the base image), Apache `rewrite` and `headers`, and the code. `vendor/` is committed, so no Composer step. The image holds **code only**: settings come in as environment variables, and uploads and the database live in Compose volumes (DO-05)." },
  { type: 'table', headers: ['File', 'What it sets'], rows: [
    ['`docker/php.ini`', 'Same limits as XAMPP (512M memory, 40M uploads), errors to the log not the page, `date.timezone = America/New_York`'],
    ['`docker/apache-honcho.conf`', 'Lets the `.htaccess` files route (as on XAMPP); hides the Apache version. Installed as `zz-honcho.conf` so it loads after Debian\'s `security.conf`'],
    ['`.dockerignore`', 'Keeps `.env`, `.git`, `docs/` and `*.sql` out of the image'],
  ]},
  { type: 'alert', variant: 'info', text: "**Build from a folder, not a piped tar.** `.dockerignore` is ignored when the build context is piped in (`git archive | docker build -`). Build from a checkout: `docker build -t honcho ~/honcho`." },
  { type: 'alert', variant: 'info', text: "**Timezone:** the app runs on New York time (`docker/php.ini`). The droplet's own clock (logs, cron, the 4:00am update reboot) is on Central." },
  { type: 'alert', variant: 'warning', text: "**Never put a key or password back into a committed file.** Add a new setting to `.env`, `.env.example` and the `env()` call in the config file. The root `.htaccess` refuses any request for `.env`." },
]},

// ============================================================
{ tab: "Server Access", blocks: [
  { type: 'p', text: "Log in with an SSH key; there is no password login." },

  { type: 'h2', text: 'One-Time Setup on the Developer Mac' },
  { type: 'ol', items: [
    "Create a key in the Terminal app (not through a `!` prompt, which can't answer questions): `ssh-keygen -t ed25519 -C \"<your email>\"`. Accept the default location and **set a passphrase**.",
    "Copy the **public** key with `pbcopy < ~/.ssh/id_ed25519.pub` and add it in DigitalOcean (Settings → Security, or on the Create Droplet form). Never share `~/.ssh/id_ed25519` (no extension); it is the private key.",
    "Load the key into the Mac's SSH agent and Keychain once: `ssh-add --apple-use-keychain ~/.ssh/id_ed25519`.",
  ]},

  { type: 'h2', text: '~/.ssh/config' },
  { type: 'p', text: "Remembers the passphrase in Keychain and gives the droplet a short name, so `ssh bpa-honcho-01` connects:" },
  { type: 'code', text: "Host *\n  AddKeysToAgent yes\n  UseKeychain yes\n  IdentityFile ~/.ssh/id_ed25519\n\nHost bpa-honcho-01\n  HostName 159.223.185.25\n  User eric" },

  { type: 'h2', text: 'Accounts and SSH Settings on the Droplet' },
  { type: 'ul', items: [
    "**`eric`** is the admin login: in the `sudo` group, same SSH key as above, and sudo needs no password (`/etc/sudoers.d/90-eric`). The passphrase-protected key is the protection; this matches DigitalOcean's and Ubuntu's own cloud images.",
    "**Root cannot log in over SSH**, and **password logins are off** for everyone. Set in `/etc/ssh/sshd_config.d/00-hardening.conf` (`PermitRootLogin no`, `PasswordAuthentication no`, `KbdInteractiveAuthentication no`). The `00-` prefix makes it win over DigitalOcean's `50-cloud-init.conf`, because sshd uses the first value it reads.",
    "To check the live values: `sudo sshd -T | grep -Ei '^(permitrootlogin|passwordauthentication)'`.",
    "To add another admin: create the user, add them to `sudo`, and put their **public** key in `/home/<user>/.ssh/authorized_keys`.",
  ]},
  { type: 'h2', text: 'Server Protection' },
  { type: 'table', headers: ['Piece', 'Setting', 'Check with'], rows: [
    ['ufw firewall', 'Incoming denied except 22 (SSH), 80, 443; outgoing allowed', '`sudo ufw status verbose`'],
    ['DigitalOcean Cloud Firewall', '`honcho-base`: inbound 22, 80, 443 from all IPv4 and IPv6; outbound default (all); applied to the droplet', 'Networking → Firewalls in the console'],
    ['fail2ban', 'Default `sshd` jail: bans an IP after repeated failed SSH logins', '`sudo fail2ban-client status sshd`'],
    ['Automatic updates', 'unattended-upgrades daily; reboots at 4:00am Central when an update needs it (after the 11pm–3am backup window). Settings in `/etc/apt/apt.conf.d/20auto-upgrades` and `52honcho-reboot`', '`apt-config dump | grep -E \'Automatic-Reboot|Unattended\'`'],
    ['Swap', '2 GB `/swapfile` (in `/etc/fstab`), `vm.swappiness=10` (`/etc/sysctl.d/99-swap.conf`), used only when memory runs short', '`swapon --show`'],
    ['Timezone', 'America/Chicago', '`timedatectl`'],
    ['Docker', 'Docker Engine 29.9 + Compose plugin v5.6 from Docker\'s apt repository (`/etc/apt/sources.list.d/docker.list`); starts on boot; `eric` is in the `docker` group (root-equivalent, like sudo). Updated by unattended-upgrades only if that origin is added; otherwise `sudo apt upgrade`', '`docker --version`, `docker compose version`, `systemctl is-active docker`'],
  ]},
  { type: 'alert', variant: 'warning', text: "**Docker skips ufw.** A port a container publishes (`ports:` in Compose) is opened by Docker's own firewall rules, around ufw. That is why the Cloud Firewall exists: it sits outside the droplet. In Compose, only Caddy publishes ports (80/443); the app and database publish none, or bind to `127.0.0.1`." },
  { type: 'alert', variant: 'warning', text: "**Locked out?** Use the DigitalOcean Recovery Console (droplet page → Access). Always run `sudo sshd -t` before reloading SSH, and keep one session open while testing a change." },
]},

// ============================================================
{ tab: "Compose Stack", blocks: [
  { type: 'p', text: "`deploy/compose.yaml` (in the repo) runs three services. Only Caddy publishes ports." },
  { type: 'table', headers: ['Service', 'What it does', 'Ports'], rows: [
    ['`caddy` (`caddy:2.10`)', 'HTTPS; gets certificates itself once DNS points at the droplet; sends each address to its app container', '80, 443 (the only open ports)'],
    ['`honcho-staging`', 'The Honcho image, built from the repo root', 'None'],
    ['`mariadb` (`mariadb:10.11`)', 'Database `bpa_staging` with its own user `bpa_staging`. Table names ignore case (`--lower-case-table-names=1`), as on the Mac; this only takes effect when the data folder is first created', 'None'],
  ]},
  { type: 'alert', variant: 'info', text: "**MariaDB 10.11, not 10.4.** 10.4 stopped getting security fixes in 2024; 10.11 is supported to 2028 and imports a 10.4 dump unchanged. Decided 2026-10-10." },
  { type: 'h2', text: 'Files on the Server' },
  { type: 'table', headers: ['Where', 'What'], rows: [
    ['`~/honcho`', 'Git clone of the repo (read-only deploy key `~/.ssh/honcho_deploy`, added in GitHub under Settings → Deploy keys)'],
    ['`~/stack/.env`', 'Compose settings: `COMPOSE_FILE` (points at the repo\'s compose file), `STACK_DIR`, `DATA_DIR`, `MARIADB_ROOT_PASSWORD`, `STAGING_DB_PASSWORD`. Template: `deploy/stack.env.example`'],
    ['`~/stack/staging.env`', 'Honcho\'s settings for staging (`BASE_URL`, `WHATENV=dev` so email goes only to the test address, `JWT_SECRET`, Brevo). The `DB_*` settings come from the compose file'],
    ['`~/stack/Caddyfile`', 'Web addresses. Template: `deploy/Caddyfile.example`'],
    ['`/srv/honcho/mariadb`', 'Database files'],
    ['`/srv/honcho/staging/files/`', 'Uploads, one folder per upload location'],
  ]},
  { type: 'p', text: "`~/stack` is mode 700 and its files 600; they hold the passwords and are never committed." },
  { type: 'h2', text: 'Upload Folders' },
  { type: 'p', text: "The app writes uploads into six folders inside the code (listed in `docker/persistent-dirs`): `public/uploads`, the DMS and CMS library `assets`, `modules/welcome/ccmps/assets` and `modules/honcho/users/assets` (photos in `<record id>/` folders), and `modules/trongate_pages/assets/images/uploads`. Each is mounted from `/srv/honcho/staging/files`, so uploads survive rebuilds. Some of these folders also hold committed files (dashboard images, the DMS user guide); the image keeps a copy, and `docker/entrypoint.sh` copies them back in on every start, never deleting an upload." },
  { type: 'alert', variant: 'warning', text: "**Adding an upload folder:** add it to both `docker/persistent-dirs` and the `volumes:` list in `deploy/compose.yaml`." },
  { type: 'h2', text: 'Everyday Commands (in ~/stack)' },
  { type: 'code', text: "cd ~/honcho && git pull          # get new code\ncd ~/stack && docker compose up -d --build   # rebuild and restart what changed\ndocker compose ps                  # status\ndocker compose logs -f honcho-staging        # app and PHP errors\ndocker compose exec mariadb sh -c 'mariadb -uroot -p\"$MARIADB_ROOT_PASSWORD\"'" },
  { type: 'p', text: "PHP sessions live inside the container, so a rebuild logs everyone out." },
]},

// ============================================================
{ tab: "Setup Steps", blocks: [
  { type: 'p', text: "The steps match the DO-xx cards on the Honcho Dev Board. Status as of 2026-10-10." },
  { type: 'table', headers: ['Step', 'What', 'Status'], rows: [
    ['DO-01', 'Create the droplet', 'Done 2026-10-08'],
    ['DO-02', 'Lock down the server: updates, Central timezone, sudo user, no root or password SSH, ufw (22/80/443), fail2ban, unattended upgrades, swap file', 'Done 2026-10-08 (see the Server Access tab)'],
    ['DO-03', 'Install Docker Engine and Compose from Docker\'s apt repository (not the snap)', 'Done 2026-10-10 (Docker 29.9, Compose v5.6)'],
    ['DO-04', 'Package Honcho: private GitHub repo, settings in `.env`, Docker image', 'Done 2026-10-10 (see the Code & Settings tab)'],
    ['DO-05', 'Compose stack: Caddy, `honcho-staging` (later `honcho-prod`), MariaDB', 'Done 2026-10-10 (see the Compose Stack tab); database empty until DO-06'],
    ['DO-06', 'Copy the database and uploads to staging', ''],
    ['DO-07', 'DNS for `uat.bpapilots.org`, HTTPS, smoke test (behind basic auth)', ''],
    ['DO-08', 'Security fixes before anything is public', ''],
    ['DO-09', 'Send Honcho\'s email through Brevo', ''],
    ['DO-10 – DO-12', 'Install Hermes; move the Mac mini scripts; run the Coffee Brief without stats', ''],
    ['DO-13 – DO-17', 'Read-only database user, reporting views, `honcho_stats` skill, stats in the brief, schedule it', ''],
    ['DO-18 – DO-19', 'Off-droplet database backups; monitoring and alerts', ''],
    ['DO-20 – DO-22', 'UAT, go-live to `members.bpapilots.org`, release checklist', ''],
  ]},
]},

];

module.exports = sections;
