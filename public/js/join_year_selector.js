const yearSelector = document.getElementById("yearSelector");
const currentYear = new Date().getFullYear();
const foundingYear = 2016;
const years = [...Array(currentYear - foundingYear + 1).keys()].map((i) => i + foundingYear);
let activeIndex = years.indexOf(currentYear);
let isAnimating = false;

function renderYears() {
	yearSelector.innerHTML = "";

	const prevYear = years[(activeIndex - 1 + years.length) % years.length];
	const currentYear = years[activeIndex];
	const nextYear = years[(activeIndex + 1) % years.length];

	[prevYear, currentYear, nextYear].forEach((year, idx) => {
		const div = document.createElement("div");
		div.className = "year";
		div.textContent = year;

		if (idx === 1) div.classList.add("active");
		yearSelector.appendChild(div);
	});
	addClickRegions();
}

function addClickRegions() {
	const leftRegion = document.createElement("div");
	leftRegion.className = "click-region left";
	leftRegion.addEventListener("click", () => animateYearChange("right"));

	const rightRegion = document.createElement("div");
	rightRegion.className = "click-region right";
	rightRegion.addEventListener("click", () => animateYearChange("left"));

	yearSelector.appendChild(leftRegion);
	yearSelector.appendChild(rightRegion);
}

function animateYearChange(direction) {
	if (isAnimating) return;
	isAnimating = true;

	yearSelector.style.transition = "transform 0.5s ease";
	yearSelector.style.transform = `translateX(${direction === "right" ? "-50px" : "50px"})`;

	setTimeout(() => {
		activeIndex =
			direction === "right"
				? (activeIndex - 1 + years.length) % years.length
				: (activeIndex + 1) % years.length;
		yearSelector.style.transition = "none";
		yearSelector.style.transform = "translateX(0)";
		renderYears();
		updateHiddenInput();
		isAnimating = false;
	}, 200);
}

function updateHiddenInput() {
	const currentYear = years[activeIndex];
	document.getElementById("join_year").value = currentYear;
}

yearSelector.addEventListener("wheel", (event) => {
	event.preventDefault();
	event.stopPropagation();

	if (event.deltaY > 0) {
		animateYearChange("left");
	} else if (event.deltaY < 0) {
		animateYearChange("right");
	}
});

renderYears();
updateHiddenInput();