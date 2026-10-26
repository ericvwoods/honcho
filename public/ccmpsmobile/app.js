// ============================================================
// app.js — BPA Member Portal
// ============================================================
// Talks to the welcome-api module (Api.php) confirmed working via
// Postman: login, mydata, update_mydata, chapterroster, directory.
// Token stored in localStorage (this is a real deployed app running
// in an actual browser, not a sandboxed preview — unlike an in-chat
// artifact, localStorage is the correct, standard tool here).
// ============================================================

// The app talks to the site it was loaded from, so the same files work
// on the Mac (http://localhost/bpausa/ccmpsmobile/), staging and production.
// SITE_BASE is everything in the page address before /ccmpsmobile/.
const SITE_BASE = window.location.origin + window.location.pathname.split('/ccmpsmobile/')[0];
const API_BASE = SITE_BASE + '/welcome-api';

// Base URL of the full web app (not the API) — used only for the Home
// screen's iframe, which loads Welcome::mobile_bridge() to convert this
// app's JWT into a real web session and render the live ccmphome page.
// Same domain as API_BASE, just without the /welcome-api suffix — kept
// as its own constant since the two could differ (e.g. a future setup
// where the mobile API and the web app live on different hosts).
const WEB_BASE_URL = SITE_BASE;

const TOKEN_KEY = 'bpa_token';

/* ------------------------------------------------------------
   Fields shown on the Profile form — must match Api.php's own
   CONTACT_TEXT_FIELDS / ADDR_TEXT_FIELDS / AUX_TEXT_FIELDS lists
   exactly, since these are the only fields the server will ever
   read or write. Adding a field here without adding it to Api.php's
   whitelist first means it'll display but silently fail to save.
   ------------------------------------------------------------ */
const PROFILE_FIELDS = [
  'salutation', 'first_name', 'middle_name', 'last_name', 'suffix',
  'call_sign',
  'email_address', 'phone', 'mobile', 'fax', 'url_string', 'website',
  'alternate_contact', 'alternate_phone', 'alternate_email',
  'emergency_contact', 'emergency_phone', 'emergency_email',
  'mailaddress1', 'mailaddress2', 'mailcity', 'mailstate', 'mailzip',
  'physaddress1', 'physaddress2', 'physcity', 'physstate', 'physzip',
  'billname', 'billaddress1', 'billaddress2', 'billcity', 'billstate', 'billzip',
  'shipname', 'shipaddress1', 'shipaddress2', 'shipcity', 'shipstate', 'shipzip',
  'highest_certificate', 'certificate_number', 'total_time',
  'ap_number', 'maintenance', 'other_crewmember', 'ocm_certnum',
  'other_faa_cert', 'ofc_certnum', 'cred_notes',
];

// Checkbox fields need separate handling from PROFILE_FIELDS — loaded
// via .checked (not .value) and saved as true/false (not a string).
// Matches Api.php's own AUX_BOOL_FIELDS list exactly.
const PROFILE_CHECKBOX_FIELDS = [
  'private', 'commercial', 'atp', 'cfi', 'cfii', 'mei', 'dpe', 'bgi', 'agi',
  'instrument', 'se_land', 'me_land', 'se_sea', 'me_sea',
  'rotocraft', 'glider', 'balloon', 'airship', 'drone',
  'dispatcher', 'atc', 'ap', 'ia',
  'military_pilot', 'military_maint',
  'former_military', // lives on ccmps, not ccmps_aux like the rest of this list — grouped here in the UI for intuitive placement, handled correctly server-side either way
  'donotcall', 'emailoptout', 'directoryoptout', 'mail_notices', // also on ccmps, Preferences section
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
  localStorage.removeItem('bpa_card'); // the saved membership card goes with the login
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

const TAB_SCREENS = ['home', 'card', 'profile', 'chapter', 'directory', 'changepw'];

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
    if (screen === 'home' && !homeLoaded) loadHome();
    if (screen === 'card') loadCard(); // every time: a card cancelled on the website shouldn't linger here
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
    showScreen('home');
    loadHome();
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
  homeLoaded = false;
  chapterLoaded = false;
  directoryLoaded = false;
  // Actively tear down the iframe's bridged session, not just the
  // flag — a shared-device scenario where a different member logs in
  // next shouldn't risk even briefly showing the previous member's
  // already-loaded home page before loadHome() runs again.
  const homeIframe = document.getElementById('home-iframe');
  homeIframe.src = 'about:blank';
  homeIframe.style.display = 'none';
  document.getElementById('home-loading').style.display = 'block';
  document.getElementById('login-username').value = '';
  document.getElementById('login-password').value = '';
  showScreen('login');
});

/* ------------------------------------------------------------
   Profile — load and save
   ------------------------------------------------------------ */

/* ------------------------------------------------------------
   Aircraft cards — a genuine one-to-many list, unlike every other
   field on this form. Each card is a small, self-contained set of
   inputs; "Add aircraft" appends a blank one, "Remove" deletes one
   from the DOM (the actual delete-on-server only happens on Save,
   same as everything else on this form — nothing here calls the API
   directly per-card).
   ------------------------------------------------------------ */

function createAircraftCard(aircraft = {}) {
  const card = document.createElement('div');
  card.className = 'aircraft-card';
  // Existing aircraft carry their real id, so update_mydata() can
  // tell "update this one" apart from "insert a new one" — blank for
  // a newly-added card.
  card.dataset.aircraftId = aircraft.id || '';

  const fields = [
    ['registration_number', 'Registration (N-number)', 'text'],
    ['make', 'Make', 'text'],
    ['model', 'Model', 'text'],
    ['hp', 'Horsepower', 'text'],
    ['engines', 'Engines', 'text'],
  ];

  fields.forEach(([field, label, type]) => {
    const wrap = document.createElement('div');
    wrap.className = 'field';
    const labelEl = document.createElement('label');
    labelEl.textContent = label;
    const input = document.createElement('input');
    input.type = type;
    input.className = 'aircraft-' + field;
    input.value = aircraft[field] || '';
    wrap.appendChild(labelEl);
    wrap.appendChild(input);
    card.appendChild(wrap);
  });

  const ownRentLabel = document.createElement('label');
  ownRentLabel.className = 'checkbox-field-inline';
  const ownRentInput = document.createElement('input');
  ownRentInput.type = 'checkbox';
  ownRentInput.className = 'aircraft-own_rent';
  ownRentInput.checked = !!aircraft.own_rent;
  ownRentLabel.appendChild(ownRentInput);
  ownRentLabel.appendChild(document.createTextNode('I own this aircraft (unchecked = rented)'));
  card.appendChild(ownRentLabel);

  const removeBtn = document.createElement('button');
  removeBtn.type = 'button';
  removeBtn.className = 'aircraft-card-remove';
  removeBtn.textContent = 'Remove';
  removeBtn.addEventListener('click', () => card.remove());
  card.appendChild(removeBtn);

  return card;
}

function renderAircraftCards(aircraftList) {
  const container = document.getElementById('aircraft-list');
  container.innerHTML = '';
  aircraftList.forEach((aircraft) => {
    container.appendChild(createAircraftCard(aircraft));
  });
}

// Collects every visible aircraft card into the array shape
// update_mydata() expects. A card that was loaded from the server
// (has a real aircraftId) but got removed from the DOM via "Remove"
// needs to be sent back with delete:true, since the server only
// knows to delete a row if it's explicitly told to — simply omitting
// it wouldn't be enough on its own without that flag.
function collectAircraftPayload(originalIds) {
  const container = document.getElementById('aircraft-list');
  const cards = Array.from(container.querySelectorAll('.aircraft-card'));
  const stillPresentIds = [];

  const payload = cards.map((card) => {
    const id = card.dataset.aircraftId || '';
    if (id) stillPresentIds.push(id);
    return {
      id: id,
      registration_number: card.querySelector('.aircraft-registration_number').value.trim(),
      make: card.querySelector('.aircraft-make').value.trim(),
      model: card.querySelector('.aircraft-model').value.trim(),
      hp: card.querySelector('.aircraft-hp').value.trim(),
      engines: card.querySelector('.aircraft-engines').value.trim(),
      own_rent: card.querySelector('.aircraft-own_rent').checked,
    };
  });

  // Any originally-loaded aircraft whose card is no longer present at
  // all (removed via "Remove") needs an explicit delete instruction.
  originalIds.forEach((id) => {
    if (!stillPresentIds.includes(id)) {
      payload.push({ id: id, delete: true });
    }
  });

  return payload;
}

let loadedAircraftIds = [];

document.getElementById('add-aircraft-btn').addEventListener('click', () => {
  document.getElementById('aircraft-list').appendChild(createAircraftCard());
});

// Fills a <select>'s options from a {id, label} list, preserving the
// existing "-- Select --" placeholder option already in the HTML.
// Clears any options added by a PREVIOUS call first — loadProfile()
// can run more than once per page session (e.g. logout then log back
// in without a full reload), and without this, each call would keep
// appending duplicate entries on top of the last set.
// Must run BEFORE anything tries to set that select's .value to a
// specific id — setting .value to an option that doesn't exist yet
// silently does nothing, it doesn't wait or retry.
function populateSelect(selectEl, items) {
  while (selectEl.options.length > 1) {
    selectEl.remove(1);
  }
  items.forEach((item) => {
    const option = document.createElement('option');
    option.value = item.id;
    option.textContent = item.label;
    selectEl.appendChild(option);
  });
}

/* ------------------------------------------------------------
   Home — embeds the web app's own live ccmphome page via the
   mobile_bridge() bridge endpoint (see Welcome.php). Only sets the
   iframe's src once per session — the bridge establishes a real web
   session on first load, so the iframe itself can handle its own
   navigation after that without needing the token again.
   ------------------------------------------------------------ */

let homeLoaded = false;

function loadHome() {
  if (homeLoaded) {
    return;
  }

  const token = getToken();
  if (!token) {
    return;
  }

  const iframe = document.getElementById('home-iframe');
  const loadingEl = document.getElementById('home-loading');

  iframe.addEventListener('load', () => {
    loadingEl.style.display = 'none';
    iframe.style.display = 'block';
  }, { once: true });

  iframe.src = WEB_BASE_URL + '/welcome/mobile_bridge?token=' + encodeURIComponent(token);
  homeLoaded = true;
}

async function loadProfile() {
  const loadingEl = document.getElementById('profile-loading');
  const formEl = document.getElementById('profile-form');
  loadingEl.style.display = 'block';
  formEl.style.display = 'none';

  try {
    // Fetched together since both are needed before the form can be
    // correctly populated — lookups() has to finish (dropdown options
    // added) before mydata()'s salutation/highest_certificate ids can
    // actually be selected.
    const [data, lookups] = await Promise.all([
      apiCall('/mydata'),
      apiCall('/lookups'),
    ]);

    populateSelect(document.getElementById('f-salutation'), lookups.salutations);
    populateSelect(document.getElementById('f-highest_certificate'), lookups.certificate_types);
    populateSelect(document.getElementById('f-mailstate'), lookups.states);
    populateSelect(document.getElementById('f-physstate'), lookups.states);
    populateSelect(document.getElementById('f-billstate'), lookups.states);
    populateSelect(document.getElementById('f-shipstate'), lookups.states);

    PROFILE_FIELDS.forEach((field) => {
      const input = document.getElementById('f-' + field);
      if (input) {
        input.value = data[field] || '';
      }
    });

    PROFILE_CHECKBOX_FIELDS.forEach((field) => {
      const input = document.getElementById('f-' + field);
      if (input) {
        input.checked = !!data[field];
      }
    });

    // Read-only display, not part of PROFILE_FIELDS/PROFILE_CHECKBOX_FIELDS
    // since none of these are ever submitted back — every one of these
    // inputs is permanently disabled.
    document.getElementById('f-ccmp_number').value = data.ccmp_number || '';
    document.getElementById('f-ccmp_type').value = data.ccmp_type || '';
    document.getElementById('f-current_year').value = data.current_year || '';
    document.getElementById('f-eligible_voter').checked = !!data.eligible_voter;
    document.getElementById('f-hall_of_fame').checked = !!data.hall_of_fame;

    const aircraftList = Array.isArray(data.aircraft) ? data.aircraft : [];
    renderAircraftCards(aircraftList);
    loadedAircraftIds = aircraftList.map((a) => String(a.id));

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

  PROFILE_CHECKBOX_FIELDS.forEach((field) => {
    const input = document.getElementById('f-' + field);
    if (input) {
      payload[field] = input.checked;
    }
  });

  payload.aircraft = collectAircraftPayload(loadedAircraftIds);

  try {
    await apiCall('/update_mydata', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload),
    });
    successEl.textContent = 'Saved.';
    // Scroll back to the top so the "Saved." confirmation is actually
    // visible — deliberately not a full page reload, which would mean
    // a fresh /mydata + /lookups round-trip and a loading flash just
    // to re-display data that hasn't changed. #screen-profile's own
    // .screen-body is the actual scrollable container (its own
    // internal overflow-y: auto), not the window itself.
    // Two earlier attempts at just calling scrollTop/scrollTo directly
    // didn't work on mobile — most likely cause: if a text input was
    // focused (keyboard open) when Save was tapped, the keyboard's own
    // dismissal triggers the browser's "scroll the last-focused input
    // back into view" behavior, which can run AFTER this code and
    // silently undo the scroll-to-top. Blurring focus first, then
    // delaying the actual scroll, lets that settle before forcing
    // the position — rather than racing against it.
    if (document.activeElement) {
      document.activeElement.blur();
    }
    setTimeout(() => {
      document.querySelector('#screen-profile .screen-body').scrollTop = 0;
      window.scrollTo(0, 0);
    }, 100);
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
    const bestPhone = m.mobile || m.phone;
    if (bestPhone) metaParts.push(bestPhone);
    if (m.email_address) metaParts.push(m.email_address);
    if (metaParts.length) {
      const meta = document.createElement('div');
      meta.className = 'member-meta';
      meta.textContent = metaParts.join(' · ');
      row.appendChild(meta);
    }

    // Tap-to-call / tap-to-email — standard tel:/mailto: links, no
    // special permission needed, work in any mobile browser. Back to
    // static "Call"/"Email" labels — the actual number/address is now
    // shown separately above, in the meta line, so the button itself
    // doesn't need to repeat it.
    if (m.phone || m.mobile || m.email_address) {
      const actions = document.createElement('div');
      actions.className = 'member-actions';

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

/* ------------------------------------------------------------
   Membership card (welcome-api/mycard). The QR is drawn here with
   qrcode-generator 1.4.4 (public/js/), cached with the app shell, so
   the card also opens without signal once it has loaded once.
   ------------------------------------------------------------ */

function renderCard(card) {
  const el = document.getElementById('member-card');
  el.style.background = card.card_color;
  document.getElementById('mc-org').textContent = card.org_name;
  document.getElementById('mc-word').textContent = card.member_word;
  document.getElementById('mc-name').textContent = card.name;
  document.getElementById('mc-number').textContent = card.member_word + ' No. ' + card.member_number;
  document.getElementById('mc-chapter').textContent = card.chapter;
  document.getElementById('mc-type').textContent = card.member_type;
  document.getElementById('mc-valid').textContent = card.valid_through;
  document.getElementById('mc-valid').style.borderBottomColor = card.accent_color;

  const photo = document.getElementById('mc-photo');
  photo.style.borderColor = card.accent_color;
  photo.textContent = '';
  if (card.photo_url) {
    const img = document.createElement('img');
    img.src = card.photo_url;
    img.alt = '';
    photo.appendChild(img);
  } else {
    photo.textContent = card.initials;
  }

  const qr = qrcode(0, 'M');
  qr.addData(card.code);
  qr.make();
  document.getElementById('mc-qr').innerHTML = qr.createSvgTag({ cellSize: 6, margin: 2, scalable: true });

  el.style.display = 'block';
  document.getElementById('card-reissue').style.display = 'block';
  try { localStorage.setItem('bpa_card', JSON.stringify(card)); } catch (e) { /* storage off: fine */ }
}

async function loadCard() {
  const loadingEl = document.getElementById('card-loading');
  try {
    const card = await apiCall('/mycard');
    renderCard(card);
    loadingEl.style.display = 'none';
  } catch (err) {
    // no signal at the door: show the card saved last time, if any
    let saved = null;
    try { saved = JSON.parse(localStorage.getItem('bpa_card') || 'null'); } catch (e) { saved = null; }
    if (saved) {
      renderCard(saved);
      loadingEl.textContent = 'Offline - showing your saved card.';
    } else {
      loadingEl.textContent = err.message;
    }
  }
}

document.getElementById('reissue-sure').addEventListener('change', (e) => {
  document.getElementById('reissue-btn').disabled = !e.target.checked;
});

document.getElementById('reissue-btn').addEventListener('click', async () => {
  const msg = document.getElementById('reissue-msg');
  try {
    const card = await apiCall('/reissuecard', { method: 'POST' });
    renderCard(card);
    msg.textContent = 'Your old card has been cancelled. This is your new card.';
    document.getElementById('reissue-sure').checked = false;
    document.getElementById('reissue-btn').disabled = true;
  } catch (err) {
    msg.textContent = err.message;
  }
});

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
   Change Password
   ------------------------------------------------------------ */

document.getElementById('changepw-form').addEventListener('submit', async (event) => {
  event.preventDefault();

  const currentInput = document.getElementById('f-current_password');
  const newInput = document.getElementById('f-new_password');
  const confirmInput = document.getElementById('f-confirm_password');
  const errorEl = document.getElementById('changepw-error');
  const successEl = document.getElementById('changepw-success');
  const saveBtn = document.getElementById('changepw-save');

  errorEl.textContent = '';
  successEl.textContent = '';

  // Client-side check that the two new-password fields match — purely
  // a UX convenience to catch typos before a round-trip; the server
  // has no way to enforce or verify this itself, since it only ever
  // receives new_password once, not a matching pair.
  if (newInput.value !== confirmInput.value) {
    errorEl.textContent = 'New password and confirmation do not match.';
    return;
  }

  saveBtn.disabled = true;
  saveBtn.textContent = 'Changing…';

  try {
    await apiCall('/change_password', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        current_password: currentInput.value,
        new_password: newInput.value,
      }),
    });
    successEl.textContent = 'Password changed.';
    currentInput.value = '';
    newInput.value = '';
    confirmInput.value = '';
  } catch (err) {
    errorEl.textContent = err.message;
  } finally {
    saveBtn.disabled = false;
    saveBtn.textContent = 'Change password';
  }
});

/* ------------------------------------------------------------
   Startup — if a token already exists (returning member), skip
   straight to Home instead of showing Login again.
   ------------------------------------------------------------ */

if (getToken()) {
  showScreen('home');
  loadHome();
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
