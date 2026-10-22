// ============================================================
// chapters/workstation.js — Developer Workstation chapter of the Honcho Developer's Guide
// ============================================================
// Part III: Installation & Configuration. Written 2026-10-22 when
// work moved from the Mac terminal to VS Code with the Claude Code
// extension. Same block format and inline markup as chapters/ccmps.js.
// ============================================================

const sections = [

// ============================================================
{ tab: "VS Code", blocks: [
  { type: 'p', text: "Honcho is developed on a Mac running XAMPP, with **Visual Studio Code** and the **Claude Code** extension. Claude Code also runs in a plain terminal; it is the same assistant with the same project instructions (`CLAUDE.md`), memory and permissions. VS Code adds a view of the files beside the conversation." },
  { type: 'h2', text: 'Setting Up' },
  { type: 'ol', items: [
    "Install VS Code from code.visualstudio.com.",
    "**File → Open Folder** and choose `/Applications/XAMPP/xamppfiles/htdocs/bpausa`. Always open this exact path: Claude Code keys its memory and past conversations to the folder path, so opening the same folder another way (e.g. `/Applications/xampp/htdocs/bpausa`) starts with no history.",
    "In the Extensions panel, install **Claude Code** (Anthropic). Optional but useful: **PHP Intelephense** (jump to a function, find its callers, syntax errors as you type).",
    "Open the Claude panel. To carry on an earlier conversation, pick it from the past-conversations list (or type `/resume`).",
    "Set **Chrome** as the Mac's default browser (System Settings → Desktop & Dock → Default web browser). Plans and other pages Claude publishes open in the default browser, and Safari reports \"browser not supported\" for them.",
  ]},
  { type: 'h2', text: 'What VS Code Adds' },
  { type: 'ul', items: [
    "Claude's edits are shown as side-by-side diffs to accept or reject before they land.",
    "Highlight code and ask about it; Claude sees the selection. Files can be @-mentioned.",
    "Clicking a reference such as `Ccmps.php:1234` opens the file at that line.",
    "Git changes, diffs and commits in the Source Control panel; several conversations in tabs.",
  ]},
  { type: 'h2', text: 'Running a Command Yourself' },
  { type: 'p', text: "In the plain terminal, typing `! <command>` runs it inside the conversation. In the VS Code panel this may not work (the text is sent as a chat message). Use VS Code's own terminal instead: **Terminal → New Terminal** opens one at the bottom, already in the project folder; paste the command without the `!`." },
  { type: 'h2', text: 'Opening Hidden Files' },
  { type: 'p', text: "Files and folders starting with a dot (`.env`, `.claude/`, `~/.claude/`) are hidden in Finder. In VS Code use **File → Open…** (Cmd+O), press **Cmd+Shift+G**, paste the path (e.g. `~/.claude/settings.json`), press Enter, then Open." },
]},

// ============================================================
{ tab: "Claude Permissions", blocks: [
  { type: 'p', text: "Claude Code asks before risky commands, or, in **auto mode**, a safety check decides on its own. Two settings files decide what goes through. Settings are read when a session starts, so start a new session (or reload VS Code) after changing them." },
  { type: 'table', headers: ['File', 'What it holds'], rows: [
    ['`.claude/settings.local.json` (project, not committed)', 'Commands always allowed in this project: `ssh bpa-honcho-01 ...` (staging checks and deploys) and `git push origin main`.'],
    ['`~/.claude/settings.json` (this Mac, every project)', 'The `autoMode.environment` notes the auto-mode check reads: the GitHub repo `github.com/ericvwoods/honcho` is **private**; the staging droplet `bpa-honcho-01` is a deploy target, deployed with `ssh bpa-honcho-01 \'cd ~/honcho && git pull && cd ~/stack && docker compose up -d --build\'` after the owner says yes.'],
  ]},
  { type: 'alert', variant: 'warning', text: "**Claude can't change these files in auto mode.** The safety check refuses any change Claude makes to its own permissions, even when asked. Edit them yourself (see Opening Hidden Files), or switch the session out of auto mode with the permission-mode selector at the bottom of the Claude panel, so Claude asks before each command instead." },
  { type: 'p', text: "Why it matters: on 2026-10-22 the first VS Code session ran in auto mode with the repo described as \"possibly public\" and no deploy target listed, so the check refused `git push` and the staging deploy (\"Data Exfiltration\"). Before, in the terminal, Claude asked and the owner approved." },
  { type: 'alert', variant: 'info', text: "Never paste a password into the conversation; it is saved in the conversation history. Test logins yourself, or put a secret in a file only you can read (`chmod 600`) for Claude to use." },
]},

];

module.exports = sections;
