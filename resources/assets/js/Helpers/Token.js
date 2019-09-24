class Token {
	
	isValid(token) {
		const payload = this.payload(token);
		if (payload) {
			return payload.iss == "http://localhost:8000/api/auth/login" || "http://localhost:8000/api/auth/signup" ? true : false
		} // end if
		return false
	} // end

    payload(token) {
    	const payload = token.split('.')[1]
    	return this.decode(payload)
    } // end

    decode(payload) {
    	if (this.isBase64(payload)) {
    		return JSON.parse(atob(payload))
    	} // end if
    	return false
    } // end
    
    isBase64(payload) {
    	try {
    		// it's like btoa(2 + 2 = 4) => 4/2 == 2 + 2
    		return btoa(atob(payload)).replace(/=/g, "") == payload
    	}		catch(err) {
    				return false
    	}
    } // end
} // end Token

export default Token = new Token()