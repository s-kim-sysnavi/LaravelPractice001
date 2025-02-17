function createSelector(id, values, initialIndex) {
	const selector = document.getElementById(id);
	let activeIndex = initialIndex;
	let isAnimating = false;

	function renderItems() {
		selector.innerHTML = "";

		const prevItem = values[(activeIndex - 1 + values.length) % values.length];
		const currentItem = values[activeIndex];
		const nextItem = values[(activeIndex + 1) % values.length];

		[prevItem, currentItem, nextItem].forEach((item, idx) => {
			const div = document.createElement("div");
			div.className = id.replace("Selector", "");
			div.textContent = item;
			if (idx === 1) div.classList.add("active");
			selector.appendChild(div);
		});
		addClickRegions();
	}

	function addClickRegions() {
		const leftRegion = document.createElement("div");
		leftRegion.className = "click-region left";
		leftRegion.addEventListener("click", () => animateChange("right"));

		const rightRegion = document.createElement("div");
		rightRegion.className = "click-region right";
		rightRegion.addEventListener("click", () => animateChange("left"));

		selector.appendChild(leftRegion);
		selector.appendChild(rightRegion);
	}

	function animateChange(direction) {
		if (isAnimating) return;
		isAnimating = true;

		selector.style.transition = "transform 0.5s ease";
		selector.style.transform = `translateX(${direction === "right" ? "-50px" : "50px"})`;

		setTimeout(() => {
			activeIndex =
				direction === "right"
					? (activeIndex - 1 + values.length) % values.length
					: (activeIndex + 1) % values.length;
			selector.style.transition = "none";
			selector.style.transform = "translateX(0)";
			renderItems();
			updateHiddenInput();
			isAnimating = false;
		}, 200);
	}

	function updateHiddenInput() {
		document.getElementById(id.replace("Selector", "")).value = values[activeIndex];
	}

	selector.addEventListener("wheel", (event) => {
		event.preventDefault();
		event.stopPropagation();
		if (event.deltaY > 0) {
			animateChange("left");
		} else if (event.deltaY < 0) {
			animateChange("right");
		}
	});

	renderItems();
	updateHiddenInput();
}

const currentYear = new Date().getFullYear();
const foundingYear = 2016;
const years = [...Array(currentYear - foundingYear + 1).keys()].map((i) => i + foundingYear);
const months = [...Array(12).keys()].map((i) => i + 1);
const days = [...Array(31).keys()].map((i) => i + 1);

createSelector("yearSelector", years, years.indexOf(currentYear));
createSelector("monthSelector", months, new Date().getMonth());
createSelector("daySelector", days, new Date().getDate() - 1);