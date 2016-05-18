auth.factory('authService', ['$q', '$http', 'store', 'jwtHelper', 
function($q, $http, store, jwtHelper) {

	var currentUser,
		isLoggedIn = false,
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
			var deferred = $q.defer();
			
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

		//Déconnecte l'utilisateur
		logout: function() {
			store.remove('jwt');
		},

		/**
		 * Retourne l'utilisateur si connecté
		 * @return {Object}
		 */
		currentUser: function() { return currentUser; },

		/**
		 * Vérifie si l'utilisateur est connecté
		 * Si l'état de connexion a été modifié, notifie les observateurs
		 * @return {Boolean} Vrai si connecté
		 */
		isLoggedIn: function() { 
			var tmp = store.get('jwt') && !jwtHelper.isTokenExpired(store.get('jwt'));
			
			//si l'état a changé
			if (tmp !== isLoggedIn) {
				isLoggedIn = tmp;
				//si connecté on récupère les infos de l'utilisateur
				if (isLoggedIn) {
					var jwt = store.get('jwt'),
						data = jwtHelper.decodeToken(jwt);

					currentUser = {
						username: data.username
					};
				}
				//sinon on les vide
				else {
					currentUser = undefined;
				}
				notifyObservers();
			}

			return isLoggedIn;
		},

		registerObserverCallback: function(callback) {
    		observerCallbacks.push(callback);
  		}
	}
}]); 