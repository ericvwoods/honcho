<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Honcho Calendar Demo</title>

<!--
    <link href="<?= BASE_URL ?>themes/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">

       
    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">


    <link href="<?= BASE_URL ?>themes/inspinia/css/animate.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>themes/inspinia/css/style.css" rel="stylesheet">

    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

    
    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">


    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

    <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/summernote/summernote-bs4.css" rel="stylesheet">
-->

<style type="text/css" media="screen">

:root {
  --primary-clr: #b38add;
}
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
/* nice scroll bar */
::-webkit-scrollbar {
  width: 5px;
}
::-webkit-scrollbar-track {
  background: #f5f5f5;
  border-radius: 50px;
}
::-webkit-scrollbar-thumb {
  background: var(--primary-clr);
  border-radius: 50px;
}

body {
  position: relative;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding-bottom: 30px;
  background-color: #e2e1dc;
}
.container {
  position: relative;
  width: 1200px;
  min-height: 850px;
  margin: 0 auto;
  padding: 5px;
  color: #fff;
  display: flex;

  border-radius: 10px;
  background-color: #373c4f;
}
.left {
  width: 60%;
  padding: 20px;
}
.calendar {
  position: relative;
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  flex-wrap: wrap;
  justify-content: space-between;
  color: #878895;
  border-radius: 5px;
  background-color: #fff;
}
/* set after behind the main element */
.calendar::before,
.calendar::after {
  content: "";
  position: absolute;
  top: 50%;
  left: 100%;
  width: 12px;
  height: 97%;
  border-radius: 0 5px 5px 0;
  background-color: #d3d4d6d7;
  transform: translateY(-50%);
}
.calendar::before {
  height: 94%;
  left: calc(100% + 12px);
  background-color: rgb(153, 153, 153);
}
.calendar .month {
  width: 100%;
  height: 150px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 50px;
  font-size: 1.2rem;
  font-weight: 500;
  text-transform: capitalize;
}
.calendar .month .prev,
.calendar .month .next {
  cursor: pointer;
}
.calendar .month .prev:hover,
.calendar .month .next:hover {
  color: var(--primary-clr);
}
.calendar .weekdays {
  width: 100%;
  height: 100px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 20px;
  font-size: 1rem;
  font-weight: 500;
  text-transform: capitalize;
}
.weekdays div {
  width: 14.28%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}
.calendar .days {
  width: 100%;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  padding: 0 20px;
  font-size: 1rem;
  font-weight: 500;
  margin-bottom: 20px;
}
.calendar .days .day {
  width: 14.28%;
  height: 90px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  color: var(--primary-clr);
  border: 1px solid #f5f5f5;
}
.calendar .days .day:nth-child(7n + 1) {
  border-left: 2px solid #f5f5f5;
}
.calendar .days .day:nth-child(7n) {
  border-right: 2px solid #f5f5f5;
}
.calendar .days .day:nth-child(-n + 7) {
  border-top: 2px solid #f5f5f5;
}
.calendar .days .day:nth-child(n + 29) {
  border-bottom: 2px solid #f5f5f5;
}

.calendar .days .day:not(.prev-date, .next-date):hover {
  color: #fff;
  background-color: var(--primary-clr);
}
.calendar .days .prev-date,
.calendar .days .next-date {
  color: #b3b3b3;
}
.calendar .days .active {
  position: relative;
  font-size: 2rem;
  color: #fff;
  background-color: var(--primary-clr);
}
.calendar .days .active::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  box-shadow: 0 0 10px 2px var(--primary-clr);
}
.calendar .days .today {
  font-size: 2rem;
}
.calendar .days .event {
  position: relative;
}
.calendar .days .event::after {
  content: "";
  position: absolute;
  bottom: 10%;
  left: 50%;
  width: 75%;
  height: 6px;
  border-radius: 30px;
  transform: translateX(-50%);
  background-color: var(--primary-clr);
}
.calendar .days .day:hover.event::after {
  background-color: #fff;
}
.calendar .days .active.event::after {
  background-color: #fff;
  bottom: 20%;
}
.calendar .days .active.event {
  padding-bottom: 10px;
}
.calendar .goto-today {
  width: 100%;
  height: 50px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 5px;
  padding: 0 20px;
  margin-bottom: 20px;
  color: var(--primary-clr);
}
.calendar .goto-today .goto {
  display: flex;
  align-items: center;
  border-radius: 5px;
  overflow: hidden;
  border: 1px solid var(--primary-clr);
}
.calendar .goto-today .goto input {
  width: 100%;
  height: 30px;
  outline: none;
  border: none;
  border-radius: 5px;
  padding: 0 20px;
  color: var(--primary-clr);
  border-radius: 5px;
}
.calendar .goto-today button {
  padding: 5px 10px;
  border: 1px solid var(--primary-clr);
  border-radius: 5px;
  background-color: transparent;
  cursor: pointer;
  color: var(--primary-clr);
}
.calendar .goto-today button:hover {
  color: #fff;
  background-color: var(--primary-clr);
}
.calendar .goto-today .goto button {
  border: none;
  border-left: 1px solid var(--primary-clr);
  border-radius: 0;
}
.container .right {
  position: relative;
  width: 40%;
  min-height: 100%;
  padding: 20px 0;
}

.right .today-date {
  width: 100%;
  height: 50px;
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  align-items: center;
  justify-content: space-between;
  padding: 0 40px;
  padding-left: 70px;
  margin-top: 50px;
  margin-bottom: 20px;
  text-transform: capitalize;
}
.right .today-date .event-day {
  font-size: 2rem;
  font-weight: 500;
}
.right .today-date .event-date {
  font-size: 1rem;
  font-weight: 400;
  color: #878895;
}
.events {
  width: 100%;
  height: 100%;
  max-height: 600px;
  overflow-x: hidden;
  overflow-y: auto;
  display: flex;
  flex-direction: column;
  padding-left: 4px;
}
.events .event {
  position: relative;
  width: 95%;
  min-height: 70px;
  display: flex;
  justify-content: center;
  flex-direction: column;
  gap: 5px;
  padding: 0 20px;
  padding-left: 50px;
  color: #fff;
  background: linear-gradient(90deg, #3f4458, transparent);
  cursor: pointer;
}
/* even event */
.events .event:nth-child(even) {
  background: transparent;
}
.events .event:hover {
  background: linear-gradient(90deg, var(--primary-clr), transparent);
}
.events .event .title {
  display: flex;
  align-items: center;
  pointer-events: none;
}
.events .event .title .event-title {
  font-size: 1rem;
  font-weight: 400;
  margin-left: 20px;
}
.events .event i {
  color: var(--primary-clr);
  font-size: 0.5rem;
}
.events .event:hover i {
  color: #fff;
}
.events .event .event-time {
  font-size: 0.8rem;
  font-weight: 400;
  color: #878895;
  margin-left: 15px;
  pointer-events: none;
}
.events .event:hover .event-time {
  color: #fff;
}
/* add tick in event after */
.events .event::after {
  content: "✓";
  position: absolute;
  top: 50%;
  right: 0;
  font-size: 3rem;
  line-height: 1;
  display: none;
  align-items: center;
  justify-content: center;
  opacity: 0.3;
  color: var(--primary-clr);
  transform: translateY(-50%);
}
.events .event:hover::after {
  display: flex;
}
.add-event {
  position: absolute;
  bottom: 30px;
  right: 30px;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1rem;
  color: #878895;
  border: 2px solid #878895;
  opacity: 0.5;
  border-radius: 50%;
  background-color: transparent;
  cursor: pointer;
}
.add-event:hover {
  opacity: 1;
}
.add-event i {
  pointer-events: none;
}
.events .no-event {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.5rem;
  font-weight: 500;
  color: #878895;
}
.add-event-wrapper {
  position: absolute;
  bottom: 100px;
  left: 50%;
  width: 90%;
  max-height: 0;
  overflow: hidden;
  border-radius: 5px;
  background-color: #fff;
  transform: translateX(-50%);
  transition: max-height 0.5s ease;
}
.add-event-wrapper.active {
  max-height: 300px;
}
.add-event-header {
  width: 100%;
  height: 50px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 20px;
  color: #373c4f;
  border-bottom: 1px solid #f5f5f5;
}
.add-event-header .close {
  font-size: 1.5rem;
  cursor: pointer;
}
.add-event-header .close:hover {
  color: var(--primary-clr);
}
.add-event-header .title {
  font-size: 1.2rem;
  font-weight: 500;
}
.add-event-body {
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  gap: 5px;
  padding: 20px;
}
.add-event-body .add-event-input {
  width: 100%;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
}
.add-event-body .add-event-input input {
  width: 100%;
  height: 100%;
  outline: none;
  border: none;
  border-bottom: 1px solid #f5f5f5;
  padding: 0 10px;
  font-size: 1rem;
  font-weight: 400;
  color: #373c4f;
}
.add-event-body .add-event-input input::placeholder {
  color: #a5a5a5;
}
.add-event-body .add-event-input input:focus {
  border-bottom: 1px solid var(--primary-clr);
}
.add-event-body .add-event-input input:focus::placeholder {
  color: var(--primary-clr);
}
.add-event-footer {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
}
.add-event-footer .add-event-btn {
  height: 40px;
  font-size: 1rem;
  font-weight: 500;
  outline: none;
  border: none;
  color: #fff;
  background-color: var(--primary-clr);
  border-radius: 5px;
  cursor: pointer;
  padding: 5px 10px;
  border: 1px solid var(--primary-clr);
}
.add-event-footer .add-event-btn:hover {
  background-color: transparent;
  color: var(--primary-clr);
}

/* media queries */

@media screen and (max-width: 1000px) {
  body {
    align-items: flex-start;
    justify-content: flex-start;
  }
  .container {
    min-height: 100vh;
    flex-direction: column;
    border-radius: 0;
  }
  .container .left {
    width: 100%;
    height: 100%;
    padding: 20px 0;
  }
  .container .right {
    width: 100%;
    height: 100%;
    padding: 20px 0;
  }
  .calendar::before,
  .calendar::after {
    top: 100%;
    left: 50%;
    width: 97%;
    height: 12px;
    border-radius: 0 0 5px 5px;
    transform: translateX(-50%);
  }
  .calendar::before {
    width: 94%;
    top: calc(100% + 12px);
  }
  .events {
    padding-bottom: 340px;
  }
  .add-event-wrapper {
    bottom: 100px;
  }
}
@media screen and (max-width: 500px) {
  .calendar .month {
    height: 75px;
  }
  .calendar .weekdays {
    height: 50px;
  }
  .calendar .days .day {
    height: 40px;
    font-size: 0.8rem;
  }
  .calendar .days .day.active,
  .calendar .days .day.today {
    font-size: 1rem;
  }
  .right .today-date {
    padding: 20px;
  }
}

.credits {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  text-align: center;
  padding: 10px;
  font-size: 12px;
  color: #fff;
  background-color: #b38add;
}
.credits a {
  text-decoration: none;
  font-weight: 600;
}
.credits a:hover {
  text-decoration: underline;
}


</style>



<!--
    <style type="text/css" media="screen">
        #spinner{
            position: fixed;
            top: 50%;
            left: 50%;
        }
    </style>

        <style>
            .blink {
                animation: blinker 0.0s linear infinite;
                color: teal;
                font-family: sans-serif;
            }
            @keyframes blinker {
                50% {
                    opacity: 0;
                }
            }
        </style>  -->

 
    <!-- New from layout  -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Toastr style -->
 <!--   <link href="<= BASE_URL ?>themes/inspinia/css/plugins/toastr/toastr.min.css" rel="stylesheet"> -->
    <title><?= SHORTSITENAME ?> MSP</title>


 <!--   <link href="<?= BASE_URL ?>themes/inspinia/css/plugins/textSpinners/spinners.css" rel="stylesheet"> -->



</head>


<!--  <body> background will be black -->
<!-- <body class="gray-bg"> -->
    <!-- <body class="skin-1"> -->
    <body class="light-skin">

<!-- <div id="app"> -->

 <div class="wrapper">  <!-- I added -->
    <main><?= Template::display($data) ?></main>
   
 </div> <!-- wrapper -->

<script>
const calendar = document.querySelector(".calendar"),
  date = document.querySelector(".date"),
  daysContainer = document.querySelector(".days"),
  prev = document.querySelector(".prev"),
  next = document.querySelector(".next"),
  todayBtn = document.querySelector(".today-btn"),
  gotoBtn = document.querySelector(".goto-btn"),
  dateInput = document.querySelector(".date-input"),
  eventDay = document.querySelector(".event-day"),
  eventDate = document.querySelector(".event-date"),
  eventsContainer = document.querySelector(".events"),
  addEventBtn = document.querySelector(".add-event"),
  addEventWrapper = document.querySelector(".add-event-wrapper "),
  addEventCloseBtn = document.querySelector(".close "),
  addEventTitle = document.querySelector(".event-name "),
  addEventFrom = document.querySelector(".event-time-from "),
  addEventTo = document.querySelector(".event-time-to "),
  addEventSubmit = document.querySelector(".add-event-btn ");

let today = new Date();
let activeDay;
let month = today.getMonth();
let year = today.getFullYear();

const months = [
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December",
];

// const eventsArr = [
//   {
//     day: 13,
//     month: 11,
//     year: 2022,
//     events: [
//       {
//         title: "Event 1 lorem ipsun dolar sit genfa tersd dsad ",
//         time: "10:00 AM",
//       },
//       {
//         title: "Event 2",
//         time: "11:00 AM",
//       },
//     ],
//   },
// ];

const eventsArr = [];
getEvents();
console.log(eventsArr);

//function to add days in days with class day and prev-date next-date on previous month and next month days and active on today
function initCalendar() {
  const firstDay = new Date(year, month, 1);
  const lastDay = new Date(year, month + 1, 0);
  const prevLastDay = new Date(year, month, 0);
  const prevDays = prevLastDay.getDate();
  const lastDate = lastDay.getDate();
  const day = firstDay.getDay();
  const nextDays = 7 - lastDay.getDay() - 1;

  date.innerHTML = months[month] + " " + year;

  let days = "";

  for (let x = day; x > 0; x--) {
    days += `<div class="day prev-date">${prevDays - x + 1}</div>`;
  }

  for (let i = 1; i <= lastDate; i++) {
    //check if event is present on that day
    let event = false;
    eventsArr.forEach((eventObj) => {
      if (
        eventObj.day === i &&
        eventObj.month === month + 1 &&
        eventObj.year === year
      ) {
        event = true;
      }
    });
    if (
      i === new Date().getDate() &&
      year === new Date().getFullYear() &&
      month === new Date().getMonth()
    ) {
      activeDay = i;
      getActiveDay(i);
      updateEvents(i);
      if (event) {
        days += `<div class="day today active event">${i}</div>`;
      } else {
        days += `<div class="day today active">${i}</div>`;
      }
    } else {
      if (event) {
        days += `<div class="day event">${i}</div>`;
      } else {
        days += `<div class="day ">${i}</div>`;
      }
    }
  }

  for (let j = 1; j <= nextDays; j++) {
    days += `<div class="day next-date">${j}</div>`;
  }
  daysContainer.innerHTML = days;
  addListner();
}

//function to add month and year on prev and next button
function prevMonth() {
  month--;
  if (month < 0) {
    month = 11;
    year--;
  }
  initCalendar();
}

function nextMonth() {
  month++;
  if (month > 11) {
    month = 0;
    year++;
  }
  initCalendar();
}

prev.addEventListener("click", prevMonth);
next.addEventListener("click", nextMonth);

initCalendar();

//function to add active on day
function addListner() {
  const days = document.querySelectorAll(".day");
  days.forEach((day) => {
    day.addEventListener("click", (e) => {
      getActiveDay(e.target.innerHTML);
      updateEvents(Number(e.target.innerHTML));
      activeDay = Number(e.target.innerHTML);
      //remove active
      days.forEach((day) => {
        day.classList.remove("active");
      });
      //if clicked prev-date or next-date switch to that month
      if (e.target.classList.contains("prev-date")) {
        prevMonth();
        //add active to clicked day afte month is change
        setTimeout(() => {
          //add active where no prev-date or next-date
          const days = document.querySelectorAll(".day");
          days.forEach((day) => {
            if (
              !day.classList.contains("prev-date") &&
              day.innerHTML === e.target.innerHTML
            ) {
              day.classList.add("active");
            }
          });
        }, 100);
      } else if (e.target.classList.contains("next-date")) {
        nextMonth();
        //add active to clicked day afte month is changed
        setTimeout(() => {
          const days = document.querySelectorAll(".day");
          days.forEach((day) => {
            if (
              !day.classList.contains("next-date") &&
              day.innerHTML === e.target.innerHTML
            ) {
              day.classList.add("active");
            }
          });
        }, 100);
      } else {
        e.target.classList.add("active");
      }
    });
  });
}

todayBtn.addEventListener("click", () => {
  today = new Date();
  month = today.getMonth();
  year = today.getFullYear();
  initCalendar();
});

dateInput.addEventListener("input", (e) => {
  dateInput.value = dateInput.value.replace(/[^0-9/]/g, "");
  if (dateInput.value.length === 2) {
    dateInput.value += "/";
  }
  if (dateInput.value.length > 7) {
    dateInput.value = dateInput.value.slice(0, 7);
  }
  if (e.inputType === "deleteContentBackward") {
    if (dateInput.value.length === 3) {
      dateInput.value = dateInput.value.slice(0, 2);
    }
  }
});

gotoBtn.addEventListener("click", gotoDate);

function gotoDate() {
  console.log("here");
  const dateArr = dateInput.value.split("/");
  if (dateArr.length === 2) {
    if (dateArr[0] > 0 && dateArr[0] < 13 && dateArr[1].length === 4) {
      month = dateArr[0] - 1;
      year = dateArr[1];
      initCalendar();
      return;
    }
  }
  alert("Invalid Date");
}

//function get active day day name and date and update eventday eventdate
function getActiveDay(date) {
  const day = new Date(year, month, date);
  const dayName = day.toString().split(" ")[0];
  eventDay.innerHTML = dayName;
  eventDate.innerHTML = date + " " + months[month] + " " + year;
}

//function update events when a day is active
function updateEvents(date) {
  let events = "";
  eventsArr.forEach((event) => {
    if (
      date === event.day &&
      month + 1 === event.month &&
      year === event.year
    ) {
      event.events.forEach((event) => {
        events += `<div class="event">
            <div class="title">
              <i class="fas fa-circle"></i>
              <h3 class="event-title">${event.title}</h3>
            </div>
            <div class="event-time">
              <span class="event-time">${event.time}</span>
            </div>
        </div>`;
      });
    }
  });
  if (events === "") {
    events = `<div class="no-event">
            <h3>No Events</h3>
        </div>`;
  }
  eventsContainer.innerHTML = events;
  saveEvents();
}

//function to add event
addEventBtn.addEventListener("click", () => {
  addEventWrapper.classList.toggle("active");
});

addEventCloseBtn.addEventListener("click", () => {
  addEventWrapper.classList.remove("active");
});

document.addEventListener("click", (e) => {
  if (e.target !== addEventBtn && !addEventWrapper.contains(e.target)) {
    addEventWrapper.classList.remove("active");
  }
});

//allow 50 chars in eventtitle
addEventTitle.addEventListener("input", (e) => {
  addEventTitle.value = addEventTitle.value.slice(0, 60);
});

function defineProperty() {
  var osccred = document.createElement("div");
  osccred.innerHTML =
    "A Project By <a href='https://www.youtube.com/channel/UCiUtBDVaSmMGKxg1HYeK-BQ' target=_blank>Open Source Coding</a>";
  osccred.style.position = "absolute";
  osccred.style.bottom = "0";
  osccred.style.right = "0";
  osccred.style.fontSize = "10px";
  osccred.style.color = "#ccc";
  osccred.style.fontFamily = "sans-serif";
  osccred.style.padding = "5px";
  osccred.style.background = "#fff";
  osccred.style.borderTopLeftRadius = "5px";
  osccred.style.borderBottomRightRadius = "5px";
  osccred.style.boxShadow = "0 0 5px #ccc";
  document.body.appendChild(osccred);
}

defineProperty();

//allow only time in eventtime from and to
addEventFrom.addEventListener("input", (e) => {
  addEventFrom.value = addEventFrom.value.replace(/[^0-9:]/g, "");
  if (addEventFrom.value.length === 2) {
    addEventFrom.value += ":";
  }
  if (addEventFrom.value.length > 5) {
    addEventFrom.value = addEventFrom.value.slice(0, 5);
  }
});

addEventTo.addEventListener("input", (e) => {
  addEventTo.value = addEventTo.value.replace(/[^0-9:]/g, "");
  if (addEventTo.value.length === 2) {
    addEventTo.value += ":";
  }
  if (addEventTo.value.length > 5) {
    addEventTo.value = addEventTo.value.slice(0, 5);
  }
});

//function to add event to eventsArr
addEventSubmit.addEventListener("click", () => {
  const eventTitle = addEventTitle.value;
  const eventTimeFrom = addEventFrom.value;
  const eventTimeTo = addEventTo.value;
  if (eventTitle === "" || eventTimeFrom === "" || eventTimeTo === "") {
    alert("Please fill all the fields");
    return;
  }

  //check correct time format 24 hour
  const timeFromArr = eventTimeFrom.split(":");
  const timeToArr = eventTimeTo.split(":");
  if (
    timeFromArr.length !== 2 ||
    timeToArr.length !== 2 ||
    timeFromArr[0] > 23 ||
    timeFromArr[1] > 59 ||
    timeToArr[0] > 23 ||
    timeToArr[1] > 59
  ) {
    alert("Invalid Time Format");
    return;
  }

  const timeFrom = convertTime(eventTimeFrom);
  const timeTo = convertTime(eventTimeTo);

  //check if event is already added
  let eventExist = false;
  eventsArr.forEach((event) => {
    if (
      event.day === activeDay &&
      event.month === month + 1 &&
      event.year === year
    ) {
      event.events.forEach((event) => {
        if (event.title === eventTitle) {
          eventExist = true;
        }
      });
    }
  });
  if (eventExist) {
    alert("Event already added");
    return;
  }
  const newEvent = {
    title: eventTitle,
    time: timeFrom + " - " + timeTo,
  };
  console.log(newEvent);
  console.log(activeDay);
  let eventAdded = false;
  if (eventsArr.length > 0) {
    eventsArr.forEach((item) => {
      if (
        item.day === activeDay &&
        item.month === month + 1 &&
        item.year === year
      ) {
        item.events.push(newEvent);
        eventAdded = true;
      }
    });
  }

  if (!eventAdded) {
    eventsArr.push({
      day: activeDay,
      month: month + 1,
      year: year,
      events: [newEvent],
    });
  }

  console.log(eventsArr);
  addEventWrapper.classList.remove("active");
  addEventTitle.value = "";
  addEventFrom.value = "";
  addEventTo.value = "";
  updateEvents(activeDay);
  //select active day and add event class if not added
  const activeDayEl = document.querySelector(".day.active");
  if (!activeDayEl.classList.contains("event")) {
    activeDayEl.classList.add("event");
  }
});

//function to delete event when clicked on event
eventsContainer.addEventListener("click", (e) => {
  if (e.target.classList.contains("event")) {
    if (confirm("Are you sure you want to delete this event?")) {
      const eventTitle = e.target.children[0].children[1].innerHTML;
      eventsArr.forEach((event) => {
        if (
          event.day === activeDay &&
          event.month === month + 1 &&
          event.year === year
        ) {
          event.events.forEach((item, index) => {
            if (item.title === eventTitle) {
              event.events.splice(index, 1);
            }
          });
          //if no events left in a day then remove that day from eventsArr
          if (event.events.length === 0) {
            eventsArr.splice(eventsArr.indexOf(event), 1);
            //remove event class from day
            const activeDayEl = document.querySelector(".day.active");
            if (activeDayEl.classList.contains("event")) {
              activeDayEl.classList.remove("event");
            }
          }
        }
      });
      updateEvents(activeDay);
    }
  }
});

//function to save events in local storage
function saveEvents() {
  localStorage.setItem("events", JSON.stringify(eventsArr));
}

//function to get events from local storage
function getEvents() {
  //check if events are already saved in local storage then return event else nothing
  if (localStorage.getItem("events") === null) {
    return;
  }
  eventsArr.push(...JSON.parse(localStorage.getItem("events")));
}

function convertTime(time) {
  //convert time to 24 hour format
  let timeArr = time.split(":");
  let timeHour = timeArr[0];
  let timeMin = timeArr[1];
  let timeFormat = timeHour >= 12 ? "PM" : "AM";
  timeHour = timeHour % 12 || 12;
  time = timeHour + ":" + timeMin + " " + timeFormat;
  return time;
}

</script>

<!-- end js function from layout  -->

<script>
function goToUrl(targetUrl) {
    window.location.href = targetUrl;
}
</script>

    <script src="<?= BASE_URL ?>themes/inspinia/js/jquery-3.7.1.min.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/sweetalert/sweetalert.min.js"></script> 
<!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.6.1/dist/sweetalert2.all.min.js"></script>  -->
 <!--    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.15/dist/sweetalert2.all.min.js"></script> -->

<!--
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/fullcalendar/moment.min.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/fullcalendar/fullcalendar.min.js"></script> -->
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?= BASE_URL ?>themes/inspinia/js/plugins/jsKnob/jquery.knob.js"></script>

       <!-- Mainly scripts -->

    <script src="<?= BASE_URL ?>themes/inspinia/js/popper.min.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/bootstrap.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/flot/jquery.flot.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/flot/jquery.flot.time.js"></script>

    <!-- Peity -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/inspinia.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Jvectormap -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- EayPIE -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/easypiechart/jquery.easypiechart.js"></script>

    <!-- Sparkline -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/demo/sparkline-demo.js"></script>

    <!-- iCheck from form-->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/iCheck/icheck.min.js"></script>

    <!-- ChartJS-->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/chartJs/Chart.min.js"></script>

    <!-- From Datatables  -->

    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/dataTables/datatables.min.js"></script>
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>
    
    <!-- CKEditor 4.20.1 Standard  -->
        
    <script src="<?= BASE_URL ?>ckeditor/ckeditor.js"></script>

    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/pdfjs/pdf.js"></script>

    <!-- BS custom file -->
    <script src="<?= BASE_URL ?>themes/inspinia/js/plugins/bs-custom-file/bs-custom-file-input.min.js"></script>


    <!-- Vue.js CDN  all pages except ccmphome which uses itself ccmphome.php-->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <!--   <script src="https://unpkg.com/vue@next"></script> -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    
    <!-- Run Scripts  -->

<script>
    CKEDITOR.replace('bulletin_editor'); // in bulletin crud.php
</script>
<script>
    CKEDITOR.replace('notice_editor'); // in notice crud.php
</script>
<script>
    CKEDITOR.replace('job_editor'); // in job crud.php
</script>
<script>
    CKEDITOR.replace('activity_editor'); // in activity crud.php
</script>
<script>
    CKEDITOR.replace('doc_editor'); // in library crud.php
</script>
<script>
    CKEDITOR.replace('marquee_editor'); // in library crud.php
</script>

<script src="https://smtpjs.com/v3/smtp.js"></script>


<!-- elastimail smtp.elastimail.com port 2525 bpaems@gmail.com 10ED5065E00E43ECC42F6B4296CF9E55C1E0 -->
<script>
    function sendEmail(){
        alert('inspinia Fired!');
        return false;
        Email.send({
        //    Host: "smtp.gmail.com",
        //   Password: "Byus4Us!!"
            Host: "smtp.elastimail.com ",
            Username: "bpaems@gmail.com",
            Password: "10ED5065E00E43ECC42F6B4296CF9E55C1E0"
            To: 'bpaems@gmail.com',
            From: document.getElementById("name").value,
            Subject: "New Sponsor Form Inquiry",
            Body: "Name: " + document.getElementById("name").value
            + "<br> Email: " + document.getElementById("email").value
            + "<br> Mobile: " + document.getElementById("phone").value
            + "<br> Message: " + document.getElementById("message").value


    }). then(
        message => alert("Message Sent!")
    );

}
</script>

      <script>
        $(document).ready(function(){
        $('.scroll_content').slimscroll({
            height: '890px' // any shorter and wont see bottom of footer without scrolling the page
        });
 //$('#sendsponsor').on('click',function(){
//alert('sendsponsor!');
// }
  //          alert('Hello');
 // bsCustomFileInput.init()  // this stoppped everything from executing
// begin from layout
            $('#toggleSpinner1').on('click',function(){
//alert('Yep1');
                document.getElementById("ibox1").style.display = "";
         //   $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
         //   $('#ibox2').children('.ibox-content').toggleClass('sk-loading');
             console.log("spinner started"); 
            });

            $('#toggleSpinner2').on('click',function(){

                document.getElementById("ibox2").style.display = "";

             console.log("spinner started"); 
            });

            $('#toggleSpinner3').on('click',function(){

                document.getElementById("ibox3").style.display = "";

             console.log("spinner started"); 
            });

            $('#toggleSpinner4').on('click',function(){

                document.getElementById("ibox4").style.display = "";

             console.log("spinner started"); 
            });

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            }); 
    // end from layout
    
           $("#bullsubmit").click(function(){
                var bulkaction = document.getElementById("selected").value;
 // alert(bulkaction); 
                if (bulkaction  == 6){ // put up a confirmation modal
/*
                 swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this imaginary file!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    });
*/
                     // works                           
                    if(confirm('This bulletin will be permanently deleted. Confirm Deletion?'))
                    {  

                    //do nothing: just let it continue executing with the deletes
                    //alert('yes!'); 
                         
                    }else{ 
                        return false; // kills php execution of the delete
                    } 



                } // if bulkaction != 6, if not ignore and keep executing
            });

           $("#ntcsubmit").click(function(){
  //alert('Fired!');          
                var bulkaction = document.getElementById("selected").value;
 // alert(bulkaction); 
                if (bulkaction  == 6){ // put up a confirmation modal
/*
                 swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this imaginary file!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    });
*/
                     // works                           
                    if(confirm('This notice will be permanently deleted. Confirm Deletion?'))
                    {  

                    //do nothing: just let it continue executing with the deletes
                    //alert('yes!'); 
                         
                    }else{ 
                        return false; // kills php execution of the delete
                    } 



                } // if bulkaction != 6, if not ignore and keep executing
            });          
             
            // set font button

            $("#FontBtn").click(function(){
             //   var nfontsize  = $("#fontsize").val();
                var nfontsize  = document.getElementById("FontSel").value;
            //    var nmfontsize = document.getElementById("MFontSel").value;
                var sarecid    = $("#recid").val();
//alert(nfontsize);
                    $.ajax({
                  
                        url:'<?= BASE_URL ?>welcome-ccmps/fontsize',
                        type: 'post',
                        data: {fontsize:nfontsize,recid:sarecid}, 
                      //  data: {fontsize:nfontsize,mfontsize:nmfontsize,recid:sarecid}, 
                      //  dataType: "json",  // if wanted to pass to php function fontsize()
              //   as json object and not input. As json could send to node.js or API

                        success:function(response){
                            $("#result").text(response);
                            setTimeout(function(){
                                $("#result").fadeOut("slow");
                                $("#fontsize").val("");
                                $("#mfontsize").val("");
                                $("#recid").val("");
                                $("#dbtupd").val("");
                                $("#myModal").modal("hide");
                            }, 2500);
                        
                        },                            
                        error:function(response){
                            $("#result").text(response); 
                       // error:function(jqXHR, textStatus, errorThrown){
                       //    var $errmsg = '<p>Status code: ' + jqXHR.status + '</p>'
                         //   console.log($errmsg);
                        }
                    });
                    
            });        
 

            // Reset password modal - Reset Password button calls MyModal2 which calls this which posts values from form to honcho/modalresetpw
            $("#ResetBtn").click(function(){
                         //   alert('Fired');  
                var req_pw_length    = $("#rpwl2").val();
                var new_password     = $("#npass2").val();
                var confirm_password = $("#cpass2").val();
                var db_to_update     = $("#dbtupd2").val();
                var sarecid          = $("#id2").val();
//alert(sarecid);
                if(new_password == "" || confirm_password == ""){ // 1st else
                    alert('All fields are required');
                  //    alert('new password ='+new_password+' confim pw ='+confirm_password+' req length ='+'All fields are required: inspinia template line 260');
                  //  confirm('This account will be permanently deleted. Confirm Deletion?'); 
                }else{ // 1st else
//alert(sarecid);
                 if(new_password.length >= req_pw_length){


                  if(new_password == confirm_password){ // 2nd else

                    $.ajax({
                        
                        url:'<?= BASE_URL ?>welcome-ccmps/modalresetpw',
                        type: 'post',
                        data: {npass:new_password,cpass:confirm_password,recid:sarecid,dbtupd:db_to_update}, // these are values posted to url as inputs (not segments)
                        success:function(response){
                            $("#result").text(response);
                            setTimeout(function(){
                                $("#result").fadeOut("slow");
                                $("#npass2").val("");
                                $("#cpass2").val("");
                                $("#dbtupd2").val("");
                                $("#myModal2").modal("hide");
                            }, 3000);                       

                        },                            
                        error:function(response){
                            $("#result").text(response); 
                       // error:function(jqXHR, textStatus, errorThrown){
                       //    var $errmsg = '<p>Status code: ' + jqXHR.status + '</p>'
                         //   console.log($errmsg);
                        }
                    });
                  }else{ // 2nd else
                    alert('The new password does not match the confirm password.');
                        setTimeout(function(){
                          //  $("#result").fadeOut("slow");
                            $("#npass").val("");
                            $("#cpass").val("");
                            $("#dbtupd").val("");
                        }, 500);
                  } // 2nd else
              }else{
                alert('The new password failed validation rules. It must be at least '+req_pw_length+' characters long.');
                        setTimeout(function(){
                          //  $("#result").fadeOut("slow");
                            $("#npass").val("");
                            $("#cpass").val("");
                            $("#dbtupd").val("");
                        }, 500);

              }



                } // 1st else above
            });




         // change password modal
            $("#ChangeBtn1").click(function(){
           //           $('#ChangeBtn').on('click',function(){

 //               alert('Fired');                
                var req_pw_length    = $("#rpwl").val();
                var current_password = $("#crpass").val();
                var new_password     = $("#npass").val();
                var confirm_password = $("#cpass").val();
                var db_to_update     = $("#dbtupd").val();
                var sarecid          = $("#recid").val();

                if(current_password =="" || new_password == "" || confirm_password == ""){ // 1st else
                    alert('All fields are required');
                  //  confirm('This account will be permanently deleted. Confirm Deletion?'); 
                }else{ // 1st else

                 if(new_password.length >= req_pw_length){


                  if(new_password == confirm_password){ // 2nd else

                    $.ajax({

                      /*  swal({
                            title: "Ajax request example",
                            text: "Submit to run ajax request",
                            url:'<?= BASE_URL ?>honcho/modalchangepw',
                            type: 'post',
                            data: {crpass:current_password,npass:new_password,cpass:confirm_password},
                            showCancelButton: true,
                            closeOnConfirm: false,
                            showLoaderOnConfirm: true
                            }, function () {
                            setTimeout(function () {
                                swal("Ajax request finished!");
                            }, 2000);
                        }); */

                        
                        url:'<?= BASE_URL ?>welcome-ccmps/modalchangepw',
                        type: 'post',
                        data: {crpass:current_password,npass:new_password,cpass:confirm_password,dbtupd:db_to_update,recid:sarecid}, // these are values posted to url as inputs (not segments)
                        success:function(response){
                            $("#result").text(response);
                            setTimeout(function(){
                                $("#result").fadeOut("slow");
                                $("#crpass").val("");
                                $("#npass").val("");
                                $("#cpass").val("");
                                $("#dbtupd").val("");
                                $("#myModal").modal("hide");
                            }, 2500);
                        

                        },                            
                        error:function(response){
                            $("#result").text(response); 
                       // error:function(jqXHR, textStatus, errorThrown){
                       //    var $errmsg = '<p>Status code: ' + jqXHR.status + '</p>'
                         //   console.log($errmsg);
                        }
                    });
                  }else{ // 2nd else
                    alert('The new password does not match the confirm password.');
                        setTimeout(function(){
                          //  $("#result").fadeOut("slow");
                            $("#npass").val("");
                            $("#cpass").val("");
                            $("#dbtupd").val("");
                        }, 500);
                  } // 2nd else
              }else{
                alert('The new password failed validation rules. It must be at least '+req_pw_length+' characters long.');
                        setTimeout(function(){
                          //  $("#result").fadeOut("slow");
                            $("#npass").val("");
                            $("#cpass").val("");
                            $("#dbtupd").val("");
                        }, 500);

              }



                } // 1st else above
            });
       });
    </script>

<!-- End Javascript   -->
<!-- </div>    id="app"  -->    
</body>

</html>

