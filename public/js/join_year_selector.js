document.addEventListener("DOMContentLoaded", () => {
    const currentYear = new Date().getFullYear();
    const currentMonth = new Date().getMonth() + 1;
    const currentDay = new Date().getDate();

    const foundingYear = 2016;
    const years = Array.from({ length: currentYear - foundingYear + 1 }, (_, i) => i + foundingYear);
    const months = Array.from({ length: 12 }, (_, i) => i + 1);
    const days = Array.from({ length: 31 }, (_, i) => i + 1);

    let activeIndex = years.indexOf(currentYear);
    let activeIndexMonth = months.indexOf(currentMonth);
    let activeIndexDay = days.indexOf(currentDay);

    function render(selector, values, activeIndex) {
        const container = selector.querySelector(".years-container, .months-container, .days-container");
        container.innerHTML = "";

        const prev = values[(activeIndex - 1 + values.length) % values.length];
        const current = values[activeIndex];
        const next = values[(activeIndex + 1) % values.length];

        [prev, current, next].forEach((value, idx) => {
            const div = document.createElement("div");
            div.className = idx === 1 ? "active" : "";
            div.textContent = value;
            container.appendChild(div);
        });
        updateHiddenInput();
    }

    function updateHiddenInput() {
        document.getElementById("join_year").value = years[activeIndex];
        document.getElementById("join_month").value = months[activeIndexMonth];
        document.getElementById("join_day").value = days[activeIndexDay];
    }

    function animateChange(selector, values, indexVar, direction) {
        if (selector.style.transition) return;

        selector.style.transition = "transform 0.5s ease";
        selector.style.transform = `translateX(${direction === "right" ? "-50px" : "50px"})`;

        setTimeout(() => {
            indexVar.value = direction === "right"
                ? (indexVar.value - 1 + values.length) % values.length
                : (indexVar.value + 1) % values.length;

            selector.style.transition = "none";
            selector.style.transform = "translateX(0)";
            render(selector, values, indexVar.value);
        }, 200);
    }

    const yearSelector = document.getElementById("yearSelector");
    const monthSelector = document.getElementById("monthSelector");
    const daySelector = document.getElementById("daySelector");

    render(yearSelector, years, activeIndex);
    render(monthSelector, months, activeIndexMonth);
    render(daySelector, days, activeIndexDay);

    yearSelector.querySelector(".click-region.left").addEventListener("click", () => animateChange(yearSelector, years, { value: activeIndex }, "right"));
    yearSelector.querySelector(".click-region.right").addEventListener("click", () => animateChange(yearSelector, years, { value: activeIndex }, "left"));

    monthSelector.querySelector(".click-region.left").addEventListener("click", () => animateChange(monthSelector, months, { value: activeIndexMonth }, "right"));
    monthSelector.querySelector(".click-region.right").addEventListener("click", () => animateChange(monthSelector, months, { value: activeIndexMonth }, "left"));

    daySelector.querySelector(".click-region.left").addEventListener("click", () => animateChange(daySelector, days, { value: activeIndexDay }, "right"));
    daySelector.querySelector(".click-region.right").addEventListener("click", () => animateChange(daySelector, days, { value: activeIndexDay }, "left"));

    updateHiddenInput();
});