document.addEventListener("DOMContentLoaded", () => {
	const dropdown = document.getElementById("role");
	const slider = document.querySelector(".slider");
	const sliderContainer = document.getElementById("toggleForm");

	// 初期の値
	if (!dropdown.value) {
		dropdown.value = "ADMIN";
	}
	let isAdmin = dropdown.value === "ADMIN";

	// 更新用関数
	function updateSlider() {
		slider.style.left = isAdmin ? "0" : "50px";
		dropdown.value = isAdmin ? "ADMIN" : "USER"; // 権限の値変更
	}

	sliderContainer.addEventListener("click", () => {
		isAdmin = !isAdmin;
		updateSlider();
	});

	// 初期状態のスライダー更新
	updateSlider();
});
