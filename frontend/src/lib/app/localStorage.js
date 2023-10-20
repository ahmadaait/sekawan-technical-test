import { browser } from '$app/environment';

export function localStorageSet(key, val) {
	if (browser) {
		// console.log(typeof val);
		if (typeof val == 'object') {
			localStorage.setItem(key, JSON.stringify(val));
			// console.log(key + ': ' + JSON.stringify(val) + ' is set as object');
		} else {
			localStorage.setItem(key, val);
			// console.log(key + ' is set string');
		}
	}
}

export function localStorageGet(key) {
	if (browser) {
		let item = localStorage.getItem(key);
		if (item) {
			let parseStatus = false;
			let parsed;
			try {
				parsed = JSON.parse(item);
				parseStatus = true;
			} catch (err) {}
			if (parseStatus) return parsed;
			else return item;
		} else return null;
	} else {
		return false;
	}
}

export function localStorageDelete(key) {
	if (browser) {
		localStorage.removeItem(key);
	}
}
