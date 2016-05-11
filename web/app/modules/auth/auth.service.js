auth.factory('authService', ['$q', '$http', 'store', 'jwtHelper', 
function($q, $http, store, jwtHelper) {

	var currentUser,
		isLoggedIn = false,
		deferred = $q.defer(),
		observerCallbacks = [];

	//Fonctions privées
	var notifyObservers = function() {
	    angular.forEach(observerCallbacks, function(callback) {
	        callback();
	    });
	};

	//Fonctions publics
	return {
		/**
		 * Connecte un utilisateur et retourne un promise
		 * @return {[type]} [description]
		 */
		login: function(username, password) {
			return $http({
				url: '/api/login',
				method: 'POST',
				data: {
					username: username,
					password: password
				}
		    }).then(function(response) {
		    	var token = response.data.token,
		    		payload = jwtHelper.decodeToken(response.data.token);
				
				store.set('jwt', token);

				currentUser = {};
				currentUser.username = payload.username;
				isLoggedIn = true;
				notifyObservers();
				
				deferred.resolve(response.data);
				return deferred.promise;
		    }, function(error) {
		    	deferred.reject(error.data);
		    	return deferred.promise;
		    });
		},

		/**
		 * Retourne l'utilisateur si connecté
		 * @return {Object}
		 */
		currentUser: function() { return currentUser; },

		isLoggedIn: function() { return isLoggedIn; },

		registerObserverCallback: function(callback) {
    		observerCallbacks.push(callback);
  		}
	}
}]); 