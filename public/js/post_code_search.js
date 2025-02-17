$(document).ready(function () {
	$("#search").click(function () {
		let zipcode = $("#post_code").val();
		if (zipcode.length === 7) {

			$.get("/api/address", { zipcode: zipcode }, function (data) {

				$("#address1").val(data.address1);
				$("#address2").val(data.address2);
				$("#address3").val(data.address3);

				if (typeof window.validateAddress1 === "function") window.validateAddress1();
				if (typeof window.validateAddress2 === "function") window.validateAddress2();
				if (typeof window.validateAddress3 === "function") window.validateAddress3();
			}).fail(function (response) {

				alert(response.responseJSON.error);
			});
		} else {
			alert("郵便番号は7桁で入力してください。");
		}
	});
});