class AppStorage {
	// storeToken will store token
	// storeUser will store user

	storeToken(token){
        localStorage.setItem('token',token);
    }

    storeUser(user){
        localStorage.setItem('user',user);
    }

	// store method will return the both storeToen and storeUser

	store(token, user){
        this.storeToken(token)
        this.storeUser(user)
    }

	// clear() will remove token and user from localStorage

	clear() {
		localStorage.removeItem('token')
		localStorage.removeItem('user')
	}

	// getToken() & getUser() will get the token & user from localStorage
	
	getToken(){
        return localStorage.getItem('token')
    }

    getUser(){
        return localStorage.getItem('user')
    }
} // end AppStorage

export default AppStorage = new AppStorage()