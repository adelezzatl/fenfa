function flashChecker(){if(navigator.appName=="Microsoft Internet Explorer"){var swf=new ActiveXObject("ShockwaveFlash.ShockwaveFlash");if(!swf){$("#on-flash").show();}}else{if(navigator.plugins&&navigator.plugins.length>0){var swf=navigator.plugins["Shockwave Flash"];if(!swf){$("#on-flash").show();}}}}
function flashChecker_edit(){if(navigator.appName=="Microsoft Internet Explorer"){var swf=new ActiveXObject("ShockwaveFlash.ShockwaveFlash");if(!swf){$("#on-flash").html("<span onclick=\"location.href='http://www.adobe.com/go/getflash'\">点按以启用Flash</span>");$("#on-flash-icon").html("<span onclick=\"location.href='http://www.adobe.com/go/getflash'\">点按以启用Flash</span>");}}else{if(navigator.plugins&&navigator.plugins.length>0){var swf=navigator.plugins["Shockwave Flash"];if(!swf){$("#on-flash").html("<span onclick=\"location.href='http://www.adobe.com/go/getflash'\">点按以启用Flash</span>");$("#on-flash-icon").html("<span onclick=\"location.href='http://www.adobe.com/go/getflash'\">点按以启用Flash</span>");}}}}
function s_earch(){var _keyword=$("#k_eyword").val().replace(/\//g,"");_keyword=_keyword.replace(/\\/g,"");_keyword=_keyword.replace(/\?/g,"");if(_keyword==""){layer.msg("请输入要查询的关键词！",1,0);$("#k_eyword").focus();}else{location.href=in_path+"index.php/home/"+_keyword;}}
function edit_app(){var xhr=new XMLHttpRequest();if($("#in_name").val()==""){layer.msg("应用名称不能为空！",1,0);$("#in_name").focus();return;}
if($("#in_nick").val()==""){layer.msg("公司名称不能为空！",1,0);$("#in_nick").focus();return;}
if($("#in_team").val()==""){layer.msg("集团信息不能为空！",1,0);$("#in_team").focus();return;}
xhr.open("GET",in_path+"source/index/ajax_profile.php?ac=edit&name="+escape($("#in_name").val())+"&nick="+escape($("#in_nick").val())+"&team="+escape($("#in_team").val())+"&id="+in_id,true);xhr.onreadystatechange=function(){if(xhr.readyState==4){if(xhr.status==200){if(xhr.responseText==-1){layer.msg("请先登录后再操作！",3,11);}else if(xhr.responseText==-2){layer.msg("应用不存在或已被删除！",3,11);}else if(xhr.responseText==-3){layer.msg("您不能编辑别人的应用！",3,8);}else if(xhr.responseText==1){layer.msg("恭喜，应用名称已保存！",3,1);setTimeout("location.reload()",1e3);}else{layer.msg("内部出现错误，请稍后再试！",3,8);}}else{layer.msg("通讯异常，请检查网络设置！",3,3);}}};xhr.send(null);}
function del_app(_id,_type){if(_type>0){$.layer({shade:[0],area:["auto","auto"],dialog:{msg:"删除操作不可逆，确认继续？",btns:2,type:4,btn:["确认","取消"],yes:function(){del_app(_id,0);},no:function(){layer.msg("已取消删除",1,0);}}});}else{var xhr=new XMLHttpRequest();xhr.open("GET",in_path+"source/index/ajax_profile.php?ac=del&id="+_id,true);xhr.onreadystatechange=function(){if(xhr.readyState==4){if(xhr.status==200){if(xhr.responseText==-1){layer.msg("请先登录后再操作！",3,11);}else if(xhr.responseText==-2){layer.msg("应用不存在或已被删除！",3,11);}else if(xhr.responseText==-3){layer.msg("您不能删除别人的应用！",3,8);}else if(xhr.responseText==1){layer.msg("恭喜，应用删除成功！",3,1);setTimeout("location.href='"+home_link+"'",1e3);}else{layer.msg("内部出现错误，请稍后再试！",3,8);}}else{layer.msg("通讯异常，请检查网络设置！",3,3);}}};xhr.send(null);}}
function profile_info(){var xhr=new XMLHttpRequest();var mobile=document.getElementById("in_mobile");var qq=document.getElementById("in_qq");var firm=document.getElementById("in_firm");var job=document.getElementById("in_job");document.getElementById("user_tips").style.display="block";if(mobile.value==""){document.getElementById("user_tips").innerHTML="手机不能为空，请填写！";mobile.focus();return;}
if(qq.value==""){document.getElementById("user_tips").innerHTML="QQ不能为空，请填写！";qq.focus();return;}
if(firm.value==""){document.getElementById("user_tips").innerHTML="公司不能为空，请填写！";firm.focus();return;}
if(job.value==""){document.getElementById("user_tips").innerHTML="职位不能为空，请填写！";job.focus();return;}
xhr.open("GET",in_path+"source/index/ajax_profile.php?ac=info&mobile="+mobile.value+"&qq="+qq.value+"&firm="+escape(firm.value)+"&job="+escape(job.value),true);xhr.onreadystatechange=function(){if(xhr.readyState==4){if(xhr.status==200){if(xhr.responseText==-1){document.getElementById("user_tips").innerHTML="请先登录后再操作！";}else if(xhr.responseText==1){document.getElementById("user_tips").innerHTML="恭喜，个人资料已更新！";setTimeout("location.reload()",1e3);}else{document.getElementById("user_tips").innerHTML="内部出现错误，请稍后再试！";}}else{document.getElementById("user_tips").innerHTML="通讯异常，请检查网络设置！";}}};xhr.send(null);}
function profile_pwd(){var xhr=new XMLHttpRequest();var old_pwd=document.getElementById("old_pwd");var new_pwd=document.getElementById("new_pwd");var rnew_pwd=document.getElementById("rnew_pwd");document.getElementById("user_tips").style.display="block";if(old_pwd.value==""){document.getElementById("user_tips").innerHTML="<li>当前密码不能为空！</li>";old_pwd.focus();return;}
if(new_pwd.value.length<6){document.getElementById("user_tips").innerHTML="<li>新密码最小长度为 6 个字符。</li>";new_pwd.focus();return;}
if(rnew_pwd.value!==new_pwd.value){document.getElementById("user_tips").innerHTML="<li>两次输入的密码不一致！</li>";rnew_pwd.focus();return;}
xhr.open("GET",in_path+"source/index/ajax_profile.php?ac=pwd&old="+old_pwd.value+"&new="+rnew_pwd.value,true);xhr.onreadystatechange=function(){if(xhr.readyState==4){if(xhr.status==200){if(xhr.responseText==-1){document.getElementById("user_tips").innerHTML="<li>请先登录后再操作！</li>";}else if(xhr.responseText==-2){document.getElementById("user_tips").innerHTML="<li>当前密码有误，请重试！</li>";}else if(xhr.responseText==1){document.getElementById("user_tips").innerHTML="<li>恭喜，密码修改成功！</li>";setTimeout("location.reload()",1e3);}else{document.getElementById("user_tips").innerHTML="<li>内部出现错误，请稍后再试！</li>";}}else{document.getElementById("user_tips").innerHTML="<li>通讯异常，请检查网络设置！</li>";}}};xhr.send(null);}
function ReturnValue(response){$(".progress-container").hide();$(".redirect-tips").show();var xhr=new XMLHttpRequest();xhr.onreadystatechange=function(){processAJAX();};xhr.open("GET",in_path+"source/pack/upload/index-uping.php?time="+response.time+"&size="+response.size+"&id="+in_id,true);xhr.send(null);function processAJAX(){if(xhr.readyState==4){if(xhr.status==200){if(xhr.responseText==-1){$(".redirect-tips").text("请先登录后再操作！");}else if(xhr.responseText==1){location.reload();}else{$(".redirect-tips").text("内部出现错误，请稍后再试！");}}}}}