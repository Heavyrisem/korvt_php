		function listbg_on(id) {
			document.getElementById(id).className="onmouse";
		}

		function listbg_off(id) {
			document.getElementById(id).className="outmouse";
		}

		function go_id(id) {
			location.href="index.php?id=" + id;
		}

		function go_link(link) {
			location.href=link;
		}

		function comment_check() { //코멘트가 있는지 체크
			if (length == 0) {break;} //없으면 탈출
			
		}

		var is_runed = "NO";
		function poll(topid) {
		var dt = new Date();
		var now_time = dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" +  dt.getDate() + " " +  dt.getHours() + ":" +  dt.getMinutes() + ":" +  dt.getSeconds();
			$.ajax({
				url: './load_comments.php',
				type: 'POST',
				dataType: 'json',
				data: { "topic_id": topic, "now_time": now_time, "is_runed": is_runed },
				success: function(result) {
					var v = 1;
					var i = 0;
					var length = result[0];
					comments =+ result[0];
					if (length == "error") {alert("댓글 로드중 오류 발생" + result[0] + " " + result['id'] + " " + result['is_runed'] + " " + result['now_time']);}
					if (length != 0) {
						while (length > i) {
							if (length == i) {break;}
							add_comment(result[v] ["comment"], result[v] ["created"]);
							v++;
							i++;		
						}
						is_runed = "YES";
					}
					//alert("END");
				},
				complete:function () {
				},
  				error:function(request,status,error){
        			document.getElementById('comment_input').value = "error!"+"\n"+"+code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error;
       			}
			});
		}