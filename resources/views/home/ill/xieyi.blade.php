<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>病历协议</title>
	<link rel="stylesheet" href="../layui/css/layui.css">
	<style type="text/css">
		#main{
			padding: 30px;
		}
	</style>
</head>
<body>
	
	<div id="main">
		<p>一、总则</p>
		<p>1.1　用户应当同意本协议的条款并按照页面上的提示完成全部的注册程序。用户在进行注册程序过程中点击&quot;同意&quot;按钮即表示用户与康复社达成协议，完全接受本协议项下的全部条款。</p>
		<p>1.2　用户注册成功后，康复社将给予每个用户一个用户帐号及相应的密码，该用户帐号和密码由用户负责保管;用户应当对以其用户帐号进行的所有活动和事件负法律责任。</p>
		<p>1.3　用户可以使用康复社各个频道单项服务，当用户使用康复社各单项服务时，用户的使用行为视为其对该单项服务的服务条款以及康复社在该单项服务中发出的各类公告的同意。</p>
		<p>1.4　康复社会员服务协议以及各个频道单项服务条款和公告可由康复社随时更新，且无需另行通知。您在使用相关服务时,应关注并遵守其所适用的相关条款。您在使用康复社提供的各项服务之前，应仔细阅读本服务协议。如您不同意本服务协议及/或随时对其的修改，您可以主动取消康复社提供的服务;您一旦使用康复社服务，即视为您已了解并完全同意本服务协议各项内容，包括康复社对服务协议随时所做的任何修改，并成为康复社用户。</p>
		<p>二、注册信息和隐私保护</p>
		<p>2.1　康复社帐号(即康复社用户ID)的所有权归康复社，用户完成注册申请手续后，获得康复社帐号的使用权。用户应提供及时、详尽及准确的个人资料，并不断更新注册资料，符合及时、详尽准确的要求。所有原始键入的资料将引用为注册资料。如果因注册信息不真实而引起的问题，并对问题发生所带来的后果，康复社不负任何责任。</p>
		<p>2.2　用户不应将其帐号、密码转让或出借予他人使用。如用户发现其帐号遭他人非法使用，应立即通知康复社。因黑客行为或用户的保管疏忽导致帐号、密码遭他人非法使用，康复社不承担任何责任。</p>
	</div>

	<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
	<script type="text/javascript">
		var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
		//给父页面传值
		$('.selectBtn').on('click', function(){
			var cid = $(this).attr('characterId');
			var cname = $(this).attr('characterName');
		    parent.$('#character_id').val(cid);
		    parent.$('#character_name').val(cname);
		    parent.layer.close(index);
		});
	</script>
</body>
</html>