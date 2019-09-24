import User from './User'

class Exception {
	
	handle(error) {
		this.isExpired(error.response.data.error)
	} // end

	isExpired(error) {
		if (error == 'Token is invalid') {
			User.logout()
		}
	} // end
} // end class

export default Exception = new Exception()