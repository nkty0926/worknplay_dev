//init sdk
window.fbAsyncInit = function() {
	FB.init({
		appId      : '523046162389443',
		cookie     : true,
		xfbml      : true,
		version    : 'v11.0'
	});
	FB.AppEvents.logPageView();
};

//load sdk
(function(d, s, id){
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement(s); js.id = id;
	js.src = "https://connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

//checkLoginState
function checkLoginState() {
	FB.getLoginStatus(function(response) {
		statusChangeCallback(response);
	});
}

//statusChangeCallback
function statusChangeCallback(response) {
	if (response.status === 'connected') {
		FB.api('/me?fields=id,email,name', function(user){
			FB.api('/me/picture?fields=url&type=large&redirect=false', function(picture){
				$.ajax({
					type : 'post',
					url : '/actions/Facebook',
					data : 'id=' + user.id + '&email=' + user.email + '&name=' + (user.name ? user.name : '') + '&picture=' + (picture.data.url ? encodeURIComponent(picture.data.url) : ''),
					success : function(result) {
						$('section').after(result);
					}
				});
			});
		});
	}
}

//feed?link=https://www.worknplay.co.kr/Work/Detail/Job/13&id=224295701605643&access_token=EAADPcZBjVVM0BAHsuE12QDAtMfx5AvKDZBY6qbFBweSxOKgoY2DrjRCkphWeZAbBHTYURr3XwBbY4lUAhrZARTon4GZC8XEMPkooJ8zrhRX7GqGFooJxshpzE6GcsglPtJitCZCwgjoJoTOibiR2CPvwZBlzDanaxCjereVtAcb6dnuZA2VStz1YEHq6UWIsuZBBLQD8mVFjmCQZDZD
function publishing() {
	FB.api(
		"/feed", "POST",
		{
			//"message":"Hello%20World!",
			"link":"https://www.worknplay.co.kr/Work/Detail/Job/13",
			"id":"224295701605643",
			"access_token":"EAADPcZBjVVM0BAHsuE12QDAtMfx5AvKDZBY6qbFBweSxOKgoY2DrjRCkphWeZAbBHTYURr3XwBbY4lUAhrZARTon4GZC8XEMPkooJ8zrhRX7GqGFooJxshpzE6GcsglPtJitCZCwgjoJoTOibiR2CPvwZBlzDanaxCjereVtAcb6dnuZA2VStz1YEHq6UWIsuZBBLQD8mVFjmCQZDZD"
		},
		function(response) { console.log(response); }
	);
}