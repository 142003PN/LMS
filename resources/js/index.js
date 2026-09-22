const toggleBtn = document.querySelector("#toggle-btn");
const sidebar = document.querySelector("#sidebar");
const sidebarToggle = document.querySelector("#sidebar-toggle");
const sidebarOverlay = document.querySelector("#sidebar-overlay");

function closeMobileSidebar() {
    sidebar.classList.remove("mobile-open");
    sidebarOverlay.classList.remove("visible");
    sidebarToggle.setAttribute("aria-expanded", "false");
}

sidebarToggle.addEventListener("click", () => {
    const isOpen = sidebar.classList.toggle("mobile-open");
    sidebarOverlay.classList.toggle("visible", isOpen);
    sidebarToggle.setAttribute("aria-expanded", String(isOpen));
});

sidebarOverlay.addEventListener("click", closeMobileSidebar);
sidebar.querySelectorAll("a").forEach(link => link.addEventListener("click", closeMobileSidebar));


function toggleSubmenu(button) {
    button.nextElementSibling.classList.toggle("show");
    button.classList.toggle("rotate");

    if(sidebar.classList.contains('closed')){
        sidebar.classList.toggle('closed');
        toggleBtn.classList.toggle('rotate');
    }
}

const userMenuToggle = document.querySelector(".user-menu-toggle");
const userMenuDropdown = document.querySelector("#user-menu-dropdown");
const darkModeToggle = document.querySelector("#dark-mode-toggle");
const logoutButton = document.querySelector("#logout-btn");

function setDarkMode(isDark) {
    document.body.classList.toggle("dark-mode", isDark);
    darkModeToggle.querySelector(".theme-status").textContent = isDark ? "On" : "Off";
    darkModeToggle.querySelector("i").className = isDark ? "fas fa-sun" : "fas fa-moon";
    localStorage.setItem("edu-dark-mode", isDark ? "enabled" : "disabled");
}

userMenuToggle.addEventListener("click", () => {
    const isOpen = userMenuToggle.getAttribute("aria-expanded") === "true";
    userMenuToggle.setAttribute("aria-expanded", String(!isOpen));
    userMenuDropdown.hidden = isOpen;
});

darkModeToggle.addEventListener("click", () => {
    setDarkMode(!document.body.classList.contains("dark-mode"));
});


document.addEventListener("click", (event) => {
    if (!event.target.closest(".user-menu")) {
        userMenuToggle.setAttribute("aria-expanded", "false");
        userMenuDropdown.hidden = true;
    }
});

setDarkMode(localStorage.getItem("edu-dark-mode") === "enabled");

const chartFont = getComputedStyle(document.body).fontFamily;
const chartGridColor = "rgba(224, 224, 224, 0.75)";

const enrollmentChart = document.querySelector("#enrollment-chart");
if (enrollmentChart) {
    new Chart(enrollmentChart, {
        type: "line",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "New learners",
                data: [18, 24, 22, 31, 28, 36, 42, 39, 48, 53, 57, 64],
                borderColor: "#212EA0",
                backgroundColor: "rgba(33, 46, 160, 0.1)",
                fill: true,
                tension: 0.4,
                pointRadius: 3,
                pointHoverRadius: 5,
                pointBackgroundColor: "#212EA0",
                pointBorderColor: "#fff",
                pointBorderWidth: 2
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: { displayColors: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0, font: { family: chartFont } },
                    grid: { color: chartGridColor, drawBorder: false }
                },
                x: {
                    ticks: { font: { family: chartFont } },
                    grid: { display: false }
                }
            }
        }
    });
}

const departmentChart = document.querySelector("#department-chart");
if (departmentChart) {
    new Chart(departmentChart, {
        type: "doughnut",
        data: {
            labels: ["Science", "Arts", "Business", "Technology"],
            datasets: [{
                data: [28, 22, 18, 32],
                backgroundColor: ["#212EA0", "#198754", "#5b6ee1", "#72b798"],
                borderColor: "#fff",
                borderWidth: 4,
                hoverOffset: 6
            }]
        },
        options: {
            maintainAspectRatio: false,
            cutout: "68%",
            plugins: {
                legend: {
                    position: "bottom",
                    labels: { usePointStyle: true, padding: 16, font: { family: chartFont } }
                }
            }
        }
    });
}
