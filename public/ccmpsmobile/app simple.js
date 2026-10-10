// ============================================================
// app.js — BPA Member Portal
// ============================================================
// Talks to the welcome-api module (Api.php) confirmed working via
// Postman: login, mydata, update_mydata, chapterroster, directory.
// Token stored in localStorage (this is a real deployed app running
// in an actual browser, not a sandboxed preview — unlike an in-chat
// artifact, localStorage is the correct, standard tool here).
// ============================================================

// Change this to match wherever the app is actually deployed —
// currently set for local XAMPP testing. For a real deployment this
// would point at the live domain instead (e.g. 'https://bpapilots.org').
const API_BASE = 'http://localhost/bpausa/welcome-api';

const TOKEN_KEY = 'bpa_token';

/* ------------------------------------------------------------
   Fields shown on the Profile form — must match Api.php's own
   CONTACT_TEXT_FIELDS / ADDR_TEXT_FIELDS / AUX_TEXT_FIELDS lists
   exactly, since these are the only fields the server will ever
   read or write. Adding a field here without adding it to Api.php's
   whitelist first means it'll display but silently fail to save.
   ------------------------------------------------------------ */
const PROFILE_FIELDS = [
  'call_sign',
  'email_address', 'phone', 'mobile', 'fax', 'website',
  'alternate_contact', 'alternate_phone', 'alternate_email',
  'emergency_contact', 'emergency_phone', 'emergency_email',
  'mailaddress1', 'mailaddress2', 'mailcity', 'mailstate', 'mailzip',
  'physaddress1', 'physaddress2', 'physcity', 'physstate', 'physzip',
  'billname', 'billaddress1', 'billcity', 'billstate', 'billzip',
  'shipname', 'shipaddress1', 'shipcity', 'shipstate', 'shipzip',
];

/* ------------------------------------------------------------
   Token helpers
   ------------------------------------------------------------ */

function getToken() {
  return localStorage.getItem(TOKEN_KEY);
}

function setToken(token) {
  localStorage.setItem(TOKEN_KEY, token);
}

function clearToken() {
  localStorage.removeItem(TOKEN_KEY);
}

/* ------------------------------------------------------------
   API helper — every authenticated call goes through this, so the
   "token expired/invalid -> force back to login" behavior is
   consistent everywhere rather than repeated in every call site.
   ------------------------------------------------------------ */

async function apiCall(path, options = {}) {
  const headers = options.headers || {};
  const token = getToken();
  if (token) {
    headers['Authorization'] = 'Bearer ' + token;
  }

  let response;
  try {
    response = await fetch(API_BASE + path, { ...options, headers });
  } catch (networkError) {
    // Genuinely offline or server unreachable — distinct from the API
    // itself returning an error, so the message can be more specific.
    throw new Error('Could not reach the server. Check your connection and try again.');
  }

  if (response.status === 401) {
    // Token expired, invalid, or the account was deactivated —
    // require_auth() on the server returns 401 for all three cases.
    // Rather than guess which one, just force a clean re-login.
    clearToken();
    showScreen('login');
    throw new Error('Your session expired — please sign in again.');
  }

  let body;
  try {
    body = await response.json();
  } catch (parseError) {
    throw new Error('Unexpected response from the server.');
  }

  if (!body.success) {
    throw new Error(body.error || 'Something went wrong.');
  }

  return body.data;
}

/* ------------------------------------------------------------
   Screen routing
   ------------------------------------------------------------ */

const TAB_SCREENS = ['profile', 'chapter', 'directory'];

function showScreen(name) {
  document.querySelectorAll('.screen').forEach((el) => el.classList.remove('active'));
  document.getElementById('screen-' + name).classList.add('active');

  const tabBar = document.getElementById('tab-bar');
  if (TAB_SCREENS.includes(name)) {
    tabBar.classList.remove('hidden');
    document.querySelectorAll('.tab-btn[data-screen]').forEach((btn) => {
      btn.classList.toggle('active', btn.dataset.screen === name);
    });
  } else {
    tabBar.classList.add('hidden');
  }
}

document.querySelectorAll('.tab-btn[data-screen]').forEach((btn) => {
  btn.addEventListener('click', () => {
    const screen = btn.dataset.screen;
    showScreen(screen);
    // Lazy-load each tab's data the first time it's opened, rather
    // than fetching all 3 up front on login — keeps the initial
    // sign-in fast, and avoids fetching data the member never looks at.
    if (screen === 'chapter' && !chapterLoaded) loadChapter();
    if (screen === 'directory' && !directoryLoaded) loadDirectory();
  });
});

/* ------------------------------------------------------------
   Login
   ------------------------------------------------------------ */

document.getElementById('login-form').addEventListener('submit', async (event) => {
  event.preventDefault();

  const username = document.getElementById('login-username').value.trim();
  const password = document.getElementById('login-password').value;
  const errorEl = document.getElementById('login-error');
  const submitBtn = document.getElementById('login-submit');

  errorEl.textContent = '';
  submitBtn.disabled = true;
  submitBtn.textContent = 'Signing in…';

  try {
    const body = new URLSearchParams({ username, password });
    const response = await fetch(API_BASE + '/login', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body,
    });

    let data;
    try {
      data = await response.json();
    } catch (e) {
      throw new Error('Unexpected response from the server.');
    }

    if (!data.success) {
      throw new Error(data.error || 'Sign in failed.');
    }

    setToken(data.data.token);
    showScreen('profile');
    loadProfile();
  } catch (err) {
    errorEl.textContent = err.message;
  } finally {
    submitBtn.disabled = false;
    submitBtn.textContent = 'Sign in';
  }
});

document.getElementById('logout-btn').addEventListener('click', () => {
  clearToken();
  chapterLoaded = false;
  directoryLoaded = false;
  document.getElementById('login-username').value = '';
  document.getElementById('login-password').value = '';
  showScreen('login');
});

/* ------------------------------------------------------------
   Profile — load and save
   ------------------------------------------------------------ */

async function loadProfile() {
  const loadingEl = document.getElementById('profile-loading');
  const formEl = document.getElementById('profile-form');
  loadingEl.style.display = 'block';
  formEl.style.display = 'none';

  try {
    const data = await apiCall('/mydata');
    PROFILE_FIELDS.forEach((field) => {
      const input = document.getElementById('f-' + field);
      if (input) {
        input.value = data[field] || '';
      }
    });
    loadingEl.style.display = 'none';
    formEl.style.display = 'block';
  } catch (err) {
    loadingEl.textContent = err.message;
  }
}

document.getElementById('profile-form').addEventListener('submit', async (event) => {
  event.preventDefault();

  const errorEl = document.getElementById('profile-error');
  const successEl = document.getElementById('profile-success');
  const saveBtn = document.getElementById('profile-save');

  errorEl.textContent = '';
  successEl.textContent = '';
  saveBtn.disabled = true;
  saveBtn.textContent = 'Saving…';

  const payload = {};
  PROFILE_FIELDS.forEach((field) => {
    const input = document.getElementById('f-' + field);
    if (input) {
      payload[field] = input.value.trim();
    }
  });

  try {
    await apiCall('/update_mydata', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload),
    });
    successEl.textContent = 'Saved.';
  } catch (err) {
    errorEl.textContent = err.message;
  } finally {
    saveBtn.disabled = false;
    saveBtn.textContent = 'Save changes';
  }
});

/* ------------------------------------------------------------
   Chapter roster / Directory — shared rendering, since both
   endpoints return the same member shape.
   ------------------------------------------------------------ */

let chapterLoaded = false;
let directoryLoaded = false;
let chapterMembers = [];
let directoryMembers = [];

function renderMemberList(listEl, members, emptyMessage) {
  listEl.innerHTML = '';

  if (members.length === 0) {
    const empty = document.createElement('li');
    empty.className = 'empty-state';
    empty.textContent = emptyMessage;
    listEl.appendChild(empty);
    return;
  }

  members.forEach((m) => {
    const row = document.createElement('li');
    row.className = 'member-row';

    const name = document.createElement('div');
    name.className = 'member-name';
    name.textContent = [m.first_name, m.last_name].filter(Boolean).join(' ');
    row.appendChild(name);

    const metaParts = [];
    if (m.call_sign) metaParts.push(m.call_sign);
    if (m.chapter_title) metaParts.push(m.chapter_title);
    if (metaParts.length) {
      const meta = document.createElement('div');
      meta.className = 'member-meta';
      meta.textContent = metaParts.join(' · ');
      row.appendChild(meta);
    }

    // Tap-to-call / tap-to-email — standard tel:/mailto: links, no
    // special permission needed, work in any mobile browser.
    if (m.phone || m.mobile || m.email_address) {
      const actions = document.createElement('div');
      actions.className = 'member-actions';

      const bestPhone = m.mobile || m.phone;
      if (bestPhone) {
        const call = document.createElement('a');
        call.href = 'tel:' + bestPhone;
        call.textContent = 'Call';
        actions.appendChild(call);
      }
      if (m.email_address) {
        const email = document.createElement('a');
        email.href = 'mailto:' + m.email_address;
        email.textContent = 'Email';
        actions.appendChild(email);
      }
      row.appendChild(actions);
    }

    listEl.appendChild(row);
  });
}

// Live/incremental search — matches against name and call sign,
// case-insensitive substring match, filtering the already-fetched
// list client-side rather than re-hitting the API on every keystroke.
function memberMatchesQuery(member, query) {
  const haystack = [member.first_name, member.last_name, member.call_sign]
    .filter(Boolean)
    .join(' ')
    .toLowerCase();
  return haystack.includes(query.toLowerCase());
}

function wireSearch(inputEl, getMembers, listEl, emptyMessage) {
  inputEl.addEventListener('input', () => {
    const query = inputEl.value.trim();
    const members = getMembers();
    const filtered = query
      ? members.filter((m) => memberMatchesQuery(m, query))
      : members;
    renderMemberList(listEl, filtered, query ? 'No members match your search.' : emptyMessage);
  });
}

wireSearch(
  document.getElementById('chapter-search'),
  () => chapterMembers,
  document.getElementById('chapter-list'),
  'No other members found in your chapter.'
);

wireSearch(
  document.getElementById('directory-search'),
  () => directoryMembers,
  document.getElementById('directory-list'),
  'No current members found.'
);

async function loadChapter() {
  const loadingEl = document.getElementById('chapter-loading');
  const listEl = document.getElementById('chapter-list');
  const searchEl = document.getElementById('chapter-search');

  try {
    const data = await apiCall('/chapterroster');
    chapterMembers = data.members;
    renderMemberList(listEl, chapterMembers, 'No other members found in your chapter.');
    loadingEl.style.display = 'none';
    searchEl.style.display = 'block';
    chapterLoaded = true;
  } catch (err) {
    loadingEl.textContent = err.message;
  }
}

async function loadDirectory() {
  const loadingEl = document.getElementById('directory-loading');
  const listEl = document.getElementById('directory-list');
  const searchEl = document.getElementById('directory-search');

  try {
    const data = await apiCall('/directory');
    directoryMembers = data.members;
    renderMemberList(listEl, directoryMembers, 'No current members found.');
    loadingEl.style.display = 'none';
    searchEl.style.display = 'block';
    directoryLoaded = true;
  } catch (err) {
    loadingEl.textContent = err.message;
  }
}

/* ------------------------------------------------------------
   Startup — if a token already exists (returning member), skip
   straight to Profile instead of showing Login again.
   ------------------------------------------------------------ */

if (getToken()) {
  showScreen('profile');
  loadProfile();
} else {
  showScreen('login');
}

/* ------------------------------------------------------------
   Service worker registration
   ------------------------------------------------------------ */

if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker.register('./sw.js').catch((err) => {
      console.warn('Service worker registration failed:', err);
    });
  });
}
