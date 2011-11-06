
function get_url(type, col1, col2, points) {
	var url = "api/endpoint.php?uid="+glob_uid+"&m="+type+"&p="+col1+"&q="+col2+"&n="+points;
	return url;
}
