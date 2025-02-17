//submit用ステータス確認関数
const fieldStates = {
	email: false,
	password: false,
	passwordconfirm: false,
	lastname: false,
	firstname: false,
	lastnamekana: false,
	firstnamekana: false,
	//	gender: false,
	// address: false,
	// joinyear: false
};

const emailInput = document.getElementById('email');
const emailError = document.getElementById('emailError');
const passwordInput = document.getElementById('password');
const passwordError = document.getElementById('passwordError');
const passwordconfirmInput = document.getElementById('password_confirmation');
const passwordconfirmError = document.getElementById('passwordConfirmError');
const lastnameInput = document.getElementById('last_name');
const lastnameError = document.getElementById('lastNameError');
const firstnameInput = document.getElementById('first_name');
const firstnameError = document.getElementById('firstNameError');
const lastnamekanaInput = document.getElementById('last_name_kana');
const lastnamekanaError = document.getElementById('lastNameKanaError');
const firstnamekanaInput = document.getElementById('first_name_kana');
const firstnamekanaError = document.getElementById('firstNameKanaError');
const postcodeInput = document.getElementById('post_code');
const postcodeError = document.getElementById('postCodeError');

//const seiInput = document.getElementById('sei');
//const seiError = document.getElementById('seiError');
const address1Input = document.getElementById('address1');
const address1Error = document.getElementById('address1Error');
const address2Input = document.getElementById('address2');
const address2Error = document.getElementById('address2Error');
const address3Input = document.getElementById('address3');
const address3Error = document.getElementById('address3Error');
// const joinyearInput = document.getElementById('join_year');
// const joinyearError = document.getElementById('joinYearError');
const submitButton = document.querySelector('button[type="submit"]');

// email形式検証
function validateEmail(value) {
	const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
	return emailPattern.test(value.trim());
}

function validateemail() {
	const value = emailInput.value;

	if (value.trim() === '') {
		emailError.textContent = 'メールアドレスを入力してください。';
		fieldStates.email = false;
	}
	else if (!validateEmail(value)) {
		emailError.textContent = '正しい形式のメールアドレスを入力してください。';
		fieldStates.email = false;
	}
	else {
		emailError.textContent = '';
		fieldStates.email = true;
	}
	toggleSubmitButton();
}

function validatePassword() {
	const value = passwordInput.value;

	if (value.trim() === '') {
		passwordError.textContent = 'パスワードを入力してください';
		fieldStates.password = false;
	}
	else if (value.trim().length < 4) {
		passwordError.textContent = 'パスワードは4文字以上で入力してください';
		fieldStates.password = false;
	}
	else {
		passwordError.textContent = '';
		fieldStates.password = true;
	}
	toggleSubmitButton();
}

function validatePasswordConfirm() {
	const value = passwordconfirmInput.value;

	if (value === '') {
		passwordconfirmError.textContent = '確認用パスワードを入力してください';
		fieldStates.passwordconfirm = false;
	} else if (value !== passwordInput.value) {
		passwordConfirmError.textContent = 'パスワードが一致しません';
		fieldStates.passwordconfirm = false;
	} else {
		passwordConfirmError.textContent = '';
		fieldStates.passwordconfirm = true;
	}

	toggleSubmitButton();
}
function validateFirstName() {
	const value = firstnameInput.value;

	if (value.trim() === '') {
		firstnameError.textContent = '名前を入力してください';
		fieldStates.firstname = false;
	}
	else {
		firstnameError.textContent = '';
		fieldStates.firstname = true;
	}
	toggleSubmitButton();
}

function validateLastName() {
	const value = lastnameInput.value;

	if (value.trim() === '') {
		lastnameError.textContent = '苗字を入力してください';
		fieldStates.lastname = false;
	}
	else {
		lastnameError.textContent = '';
		fieldStates.lastname = true;
	}
	toggleSubmitButton();
}

function validateLastNameKana() {
	const value = lastnamekanaInput.value;

	if (value.trim() === '') {
		lastnamekanaError.textContent = '苗字(カナ)を入力してください';
		fieldStates.lastnamekana = false;
	}
	else {
		lastnamekanaError.textContent = '';
		fieldStates.lastnamekana = true;
	}
	toggleSubmitButton();
}

function validateFirstNameKana() {
	const value = firstnamekanaInput.value;

	if (value.trim() === '') {
		firstnamekanaError.textContent = '名前(カナ)を入力してください';
		fieldStates.firstnamekana = false;
	}
	else {
		firstnamekanaError.textContent = '';
		fieldStates.firstnamekana = true;
	}
	toggleSubmitButton();
}

function validatePostCode() {
	const value = postcodeInput.value;

	if (value.trim() === '') {
		postcodeError.textContent = '郵便番号を入力してください';
		fieldStates.postcode = false;
	}
	else {
		postcodeError.textContent = '';
		fieldStates.postcode = true;
	}
	toggleSubmitButton();
}


//function validateGender() {
//	const value = seiInput.value;
//
//	if (value.trim() === '') {
//		seiError.textContent = '性別を選択してください';
//		fieldStates.gender = false;
//	}
//	else {
//		seiError.textContent = '';
//		fieldStates.gender = true;
//	}
//	toggleSubmitButton();
//}




function validateAddress1() {
	const value = address1Input.value;

	if (value.trim() === '') {
		address1Error.textContent = '住所1を入力してください';
		fieldStates.address1 = false;
	}
	else {
		address1Error.textContent = '';
		fieldStates.address1 = true;
	}
	toggleSubmitButton();
}

function validateAddress2() {
	const value = address2Input.value;

	if (value.trim() === '') {
		address2Error.textContent = '住所2を入力してください';
		fieldStates.address2 = false;
	}
	else {
		address2Error.textContent = '';
		fieldStates.address2 = true;
	}
	toggleSubmitButton();
}

function validateAddress3() {
	const value = address3Input.value;

	if (value.trim() === '') {
		address3Error.textContent = '住所3を入力してください';
		fieldStates.address3 = false;
	}
	else {
		address3Error.textContent = '';
		fieldStates.address3 = true;
	}
	toggleSubmitButton();
}



// function validateJoinYear() {
// 	const value = nenInput.value;

// 	if (value.trim() === '') {
// 		joinyearError.textContent = '入社年度を選択してください';
// 		fieldStates.joinyear = false;
// 	}
// 	else {
// 		joinyearError.textContent = '';
// 		fieldStates.joinyear = true;
// 	}
// 	toggleSubmitButton();
// }

function toggleSubmitButton() {
	const allValid = Object.values(fieldStates).every(state => state === true);
	submitButton.disabled = !allValid;
}

document.addEventListener('DOMContentLoaded', () => {
	validateemail();
	validatePassword();
	validatePasswordConfirm();
	validateLastName();
	validateFirstName();
	validateLastNameKana();
	validateFirstNameKana();
	validatePostCode();
	//	validateGender();
	validateAddress1();
	validateAddress2();
	validateAddress3();
	// validateJoinYear();
});

emailInput.addEventListener('input', validateemail);
passwordInput.addEventListener('input', validatePassword);
passwordconfirmInput.addEventListener('input', validatePasswordConfirm);
lastnameInput.addEventListener('input', validateLastName);
firstnameInput.addEventListener('input', validateFirstName);
lastnamekanaInput.addEventListener('input', validateLastNameKana);
firstnamekanaInput.addEventListener('input', validateFirstNameKana);
postcodeInput.addEventListener('input', validatePostCode);

//seiInput.addEventListener('input', validateGender);

address1Input.addEventListener('input', validateAddress1);
address2Input.addEventListener('input', validateAddress2);
address3Input.addEventListener('input', validateAddress3);
// joinyearInput.addEventListener('input', validateJoinYear);

