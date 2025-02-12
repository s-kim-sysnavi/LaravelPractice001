document.addEventListener("DOMContentLoaded", function() {
	var modal = document.getElementById("customModal");
	var closeModalButton = document.querySelector(".custom-close");
	var wellcome = document.getElementById("wellcome");

	wellcome.style.display = "block";
	wellcome.style.visibility = "visible";

	if (document.referrer.includes("/login")) {
		wellcome.style.top = "110%";
		wellcome.style.left = "75%";
		wellcome.style.visibility = "visible";
		wellcome.style.display = "block";

		setTimeout(() => {
			wellcome.classList.add("show");

			let topPosition = 110;
			let moveUp = setInterval(() => {
				if (topPosition > 90) {
					topPosition -= 0.5;
					wellcome.style.top = topPosition + "%";
				} else {
					clearInterval(moveUp);
				}
			}, 30);

			setTimeout(() => {
				let moveDown = setInterval(() => {
					if (topPosition < 110) {
						topPosition += 0.5;
						wellcome.style.top = topPosition + "%";
					} else {
						clearInterval(moveDown);
						wellcome.style.display = "none";
					}
				}, 30);
			}, 5000);
		}, 500);
	}

	closeModalButton.addEventListener("click", function() {
		modal.style.display = "none";
	});
});

let clickCount = 0;
const image = document.querySelector(".circle-image-for-modal");
const easterEgg = document.getElementById("easterEgg");

image.addEventListener("click", () => {
	clickCount++;
	if (clickCount === 5) {
		showEasterEgg();
		clickCount = 0; // カウントをリセット
	}
});

function showEasterEgg() {
	easterEgg.style.display = "block"; // 画像を表示
	setTimeout(() => {
		easterEgg.classList.add("show"); // スライドイン
	}, 10);

	setTimeout(() => {
		easterEgg.classList.remove("show"); // スライドアウト
	}, 5000); // 5秒後にスライドアウト

	setTimeout(() => {
		easterEgg.style.display = "none"; // 完全に非表示
	}, 6000);
}
