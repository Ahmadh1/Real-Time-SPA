import Token from './Token';
import AppStorage from './AppStorage';

class User {
	login(data, error) {
		axios.post('/api/auth/login', data)
			.then(res => this.resAfterLogin(res))
			.catch((err) => {
				// console.log(err)
				error = err.response.data.errors
			})
	}

	resAfterLogin(res) {
		const access_token = res.data.access_token
		const username = res.data.user
		if (Token.isValid(access_token)) {
			AppStorage.store(access_token, username)
			window.location = '/forum';
		}
	}

	hasToken() {
		const storedToken = AppStorage.getToken();
		if (storedToken) {
			return Token.isValid(storedToken) ? true : this.logout()
		}
		return false
	}

	loggedIn() {
		return this.hasToken();
	}

	logout() {
		AppStorage.clear();
		window.location = '/forum';
	}

	name() {
		if (this.loggedIn()) { AppStorage.getUser() }
	}

	id() {
		if (this.loggedIn()) { 
			const payload = Token.payload(AppStorage.getToken())
			return payload.sub
		}
	}

	own(id) {
		return this.id() == id
	}

	admin() {
		return this.id() == 13
	}
} // end User

export default User = new User();