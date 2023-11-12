window.addEventListener("load", () => {
	const btn = document.querySelector("#submit");
	const form = document.querySelector("#form-register");

	const sendLeads = () => {
		var formData = new FormData(form);
		var obj = {};
		formData.forEach((value, key) => {
			obj[key] = value;
		});
		var json = JSON.stringify(obj);
		fetch(form.getAttribute("action"), {
			method: "POST",
			headers: {
				Accept: "application/json",
				"Content-type": "application/json",
			},
			body: json,
		}).then((response) => {
			console.log(response);
		});
	};
	if (btn && form) {
		btn.addEventListener("click", (e) => {
			e.preventDefault();
			sendLeads();
		});
	}
});
