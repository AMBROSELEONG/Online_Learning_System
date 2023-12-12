function loadPage(pageUrl) {
  // 通过 AJAX 或其他方式加载页面内容到右侧区域
  // 这里提供一个简单的示例
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("page-content").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", pageUrl, true);
  xhttp.send();
}