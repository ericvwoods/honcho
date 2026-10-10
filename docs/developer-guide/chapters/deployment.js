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
    ['Database', 'MariaDB 10.4.28', '`mariadb:10.4` image at first; upgrade later as its own step'],
  ]},
  { type: 'p', text: "The only hard-coded address in the code is `BASE_URL` in `config/config.php` (`http://localhost/bpausa/` locally); it moves to the per-environment `.env` file." },
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
{ tab: "Setup Steps", blocks: [
  { type: 'p', text: "The steps match the DO-xx cards on the Honcho Dev Board. Status as of 2026-10-10." },
  { type: 'table', headers: ['Step', 'What', 'Status'], rows: [
    ['DO-01', 'Create the droplet', 'Done 2026-10-08'],
    ['DO-02', 'Lock down the server: updates, Central timezone, sudo user, no root or password SSH, ufw (22/80/443), fail2ban, unattended upgrades, swap file', 'Done 2026-10-08 (see the Server Access tab)'],
    ['DO-03', 'Install Docker Engine and Compose from Docker\'s apt repository (not the snap)', 'Done 2026-10-10 (Docker 29.9, Compose v5.6)'],
    ['DO-04', 'Package Honcho: private GitHub repo, settings in `.env`, Docker image', ''],
    ['DO-05', 'Compose stack: Caddy, `honcho-staging` (later `honcho-prod`), MariaDB', ''],
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
