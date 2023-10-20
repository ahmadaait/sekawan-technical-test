import { goto } from '$app/navigation';
import { API_HOST } from '$lib/env.js';
import { localStorageDelete, localStorageGet } from './localStorage.js';

export async function xfetch(url, method, body, headers, host) {
	if (!headers) headers = new Headers();
	if (!host) host = API_HOST;
	let customError;

	if (!(body instanceof FormData)) {
		// headers['Content-Type'] = 'application/vnd.api+json';
		headers.append('Content-Type', 'application/json');
		body = JSON.stringify(body);
	}

	const access_token = localStorageGet('auth');
	if (access_token) {
		headers.append('Authorization', 'Bearer ' + access_token);
		// headers['Authorization'] = 'Bearer ' + access_token;
	}

	const res = await fetch(host + url, {
		method: method,
		body,
		headers
	});

	var finalRes = {};
	finalRes.status = res.status;

	if (res.ok) {
		await res.json().then((val) => {
			if (val.data) finalRes.data = val.data;
			else finalRes.data = val;
		});
	} else if (res.status === 401) {
		localStorageDelete('auth');
		goto('/login');
	} else {
		finalRes.errors = [];
		await res.json().then((thenJson) => {
			if (thenJson.errors && thenJson.errors.length > 0) {
				finalRes.errors = thenJson.errors;
			}
		});
	}

	return finalRes;
}
