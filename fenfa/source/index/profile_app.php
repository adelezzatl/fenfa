<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php if(!$GLOBALS['userlogined']){exit(header('location:'.IN_PATH.'index.php/login'));} ?>
<?php
$app = explode('/', $_SERVER['PATH_INFO']);
$id = intval(isset($app[2]) ? $app[2] : NULL);
$row = $GLOBALS['db']->getrow("select * from ".tname('app')." where in_uid=".$GLOBALS['erduo_in_userid']." and in_id=".$id);
$row or exit(header('location:'.IN_PATH));
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="x-ua-compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<meta charset="<?php echo IN_CHARSET; ?>">
<title><?php echo $row['in_name']; ?> - �ҵ�Ӧ�� - <?php echo IN_NAME; ?></title>
<link href="<?php echo IN_PATH; ?>static/index/icons.css" rel="stylesheet">
<link href="<?php echo IN_PATH; ?>static/index/bootstrap.css" rel="stylesheet">
<link href="<?php echo IN_PATH; ?>static/index/manage.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/confirm-lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/upload/swfobject.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/index/uploadify.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/index/uploadify-icon.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/index/profile.js"></script>
<script type="text/javascript">
var in_path = '<?php echo IN_PATH; ?>';
var home_link = '<?php echo IN_PATH.'index.php/home'; ?>';
var uploadify_img = '<?php echo IN_PATH.'static/index/uploadify_edit.png'; ?>';
var in_id = <?php echo $row['in_id']; ?>;
var in_size = <?php echo intval(ini_get('upload_max_filesize')); ?>;
var in_time = <?php echo time(); ?>;
window.onload = flashChecker_edit;
</script>
</head>
<body>
<div class="navbar-wrapper ng-scope">
	<div class="ng-scope">
		<div class="navbar-header-wrap">
			<div class="middle-wrapper">
				<sidebar class="avatar-dropdown">
				<img class="img-circle" src="<?php echo getavatar($GLOBALS['erduo_in_userid']); ?>">
				<div class="name"><span class="ng-binding"><?php echo substr($GLOBALS['erduo_in_username'], 0, strpos($GLOBALS['erduo_in_username'], '@')); ?></span></div>
				<div class="email"><span class="ng-binding"><?php echo $GLOBALS['erduo_in_username']; ?></span></div>
				<div class="dropdown-menus">
					<ul>
						<li><a href="<?php echo IN_PATH.'index.php/profile_info'; ?>" class="ng-binding">��������</a></li>
						<li><a href="<?php echo IN_PATH.'index.php/profile_pwd'; ?>">�޸�����</a></li>
						<li><a href="<?php echo IN_PATH.'index.php/profile_avatar'; ?>">����ͷ��</a></li>
						<li><a href="<?php echo IN_PATH.'index.php/logout'; ?>" class="ng-binding">�˳�</a></li>
					</ul>
				</div>
				</sidebar>
				<nav>
				<h1 class="navbar-title logo"><span onclick="location.href='<?php echo IN_PATH; ?>'"><?php echo $_SERVER['HTTP_HOST']; ?></span></h1>
				<i class="icon-angle-right"></i>
				<div class="navbar-title primary-title"><a href="<?php echo IN_PATH.'index.php/home'; ?>" class="ng-binding">�ҵ�Ӧ��</a></div>
				<i class="icon-angle-right"></i>
				<div class="navbar-title secondary-title"><?php echo $row['in_name']; ?></div>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="ng-scope" id="dialog-uploadify" style="display:none">
	<div class="upload-modal-mask ng-scope"></div>
	<div class="upload-modal-container ng-scope">
		<div class="flip-container flip">
			<div class="modal-backend plane-ready upload-modal">
				<div class="btn-close" onclick="location.reload()"><i class="icon-cross"></i></div>
				<div class="plane-wrapper">
					<img class="plane" src="<?php echo IN_PATH; ?>static/index/plane.svg">
					<div class="rotate-container">
						<img class="propeller" src="<?php echo IN_PATH; ?>static/index/propeller.svg">
					</div>
				</div>
				<div class="progress-container">
					<p class="speed ng-binding" id="speed-uploadify"></p>
					<p class="turbo-upload"></p>
					<div class="progress">
						<div class="growing" style="width:0%"></div>
					</div>
				</div>
				<div class="redirect-tips ng-binding" style="display:none">���ڽ���Ӧ�ã����Ե�...</div>
			</div>
		</div>
	</div>
</div>
<section class="ng-scope">
<div class="page-app app-info">
	<div class="banner">
		<div class="middle-wrapper clearfix">
			<div class="pull-left appicon">
				<img class="ng-isolate-scope" src="<?php echo geticon($row['in_icon']).'?time='.time(); ?>" width="100" height="100">
			</div>
			<div class="badges">
				<span class="short"><?php echo getlink($row['in_id']); ?></span>
				<span><i class="icon-cloud-download"></i><b class="ng-binding"><?php echo $row['in_hits']; ?></b></span>
				<span class="bundleid ng-binding">BundleID<b class="ng-binding">&nbsp;&nbsp;<?php echo $row['in_bid']; ?></b></span>
				<span class="version ng-scope"><?php echo $row['in_form']; ?>&nbsp;<?php echo $row['in_mnvs']; ?>&nbsp;���߸߰汾</span>
			</div>
			<div class="actions">
				<div class="upload in" id="on-flash"><input type="file" id="uploadify"></div>
				<a class="download ng-binding" href="<?php echo getlink($row['in_id']); ?>" target="_blank"><i class="icon-eye"></i> Ԥ��</a>
			</div>
			<div class="tabs-container">
				<ul class="list-inline">
					<li><a class="ng-binding active"><i class="icon-file"></i>������Ϣ</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="ng-scope">
		<div class="page-tabcontent apps-app-info">
			<div class="middle-wrapper">
				<div class="app-info-form">
					<div class="field app-id">
						<div class="left-label ng-binding">Ӧ�ñ��</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon"><?php echo $row['in_id']; ?></span>
							</div>
						</div>
					</div>
					<div class="field app-id">
						<div class="left-label ng-binding">Ӧ�ô�С</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon"><?php echo $row['in_size']; ?></span>
							</div>
						</div>
					</div>
					<div class="field app-id">
						<div class="left-label ng-binding">�汾����</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon"><?php echo $row['in_type'] > 0 ? '��ҵ��' : '�ڲ��'; ?></span>
							</div>
						</div>
					</div>
					<div class="field app-id">
						<div class="left-label ng-binding">���°汾</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon"><?php echo $row['in_bsvs'].'��Build '.$row['in_bvs'].'��'; ?></span>
							</div>
						</div>
					</div>
					<!--
					<div class="field app-id">
						<div class="left-label ng-binding">��˾����</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon"><?php echo $row['in_nick']; ?></span>
							</div>
						</div>
					</div>
					<div class="field app-id">
						<div class="left-label ng-binding">������Ϣ</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon"><?php echo $row['in_team']; ?></span>
							</div>
						</div>
					</div>
					-->
					<div class="field app-id">
						<div class="left-label ng-binding">����ʱ��</div>
						<div class="value">
							<div class="input-group">
								<span class="input-group-addon"><?php echo $row['in_addtime']; ?></span>
							</div>
						</div>
					</div>
					<hr>
					<div class="field app-short">
						<div class="left-label ng-binding">Ӧ��ͼ��</div>
						<div class="value">
							<div class="apps-app-security">
								<div class="btn-invite-member" id="on-flash-icon"><input type="file" id="uploadify-icon"></div>
							</div>
						</div>
					</div>
					<div class="field app-name">
						<div class="left-label ng-binding">Ӧ������</div>
						<div class="value">
							<input type="text" value="<?php echo $row['in_name']; ?>" id="in_name">
						</div>
					</div>
					
					
				    <div class="field app-name">
						<div class="left-label ng-binding">��˾����</div>
						<div class="value">
							<input type="text" value="<?php echo $row['in_nick']; ?>" id="in_nick">
						</div>
					</div>
					<div class="field app-name">
						<div class="left-label ng-binding">������Ϣ</div>
						<div class="value">
							<input type="text" value="<?php echo $row['in_team']; ?>" id="in_team">
						</div>
					</div>
					
					<div class="field actions">
						<div class="value">
							<button class="save ng-binding" onclick="edit_app()">����</button>
						</div>
					</div>
					<div class="field app-deletion">
						<hr>
						<div class="left-label ng-binding">ɾ��Ӧ��</div>
						<div class="value">
							<button class="btn require-confirm" onclick="del_app(in_id, 1)">
								<span class="ng-scope">ɾ��</span>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<div class="footer">
	<div class="footer-content">
		<ul class="list-inline list-unstyled navbar-footer">
			<li><a>Copyright &copy; <?php echo date('Y'); ?> <?php echo $_SERVER['HTTP_HOST']; ?> .All Rights Reserved.</a></li>
			<li><a href="mailto:<?php echo IN_MAIL; ?>">��ϵ����</a></li>
			<li><a href="http://www.miitbeian.gov.cn/" target="_blank"><?php echo IN_ICP; ?></a></li>
			<li><?php echo base64_decode(IN_STAT); ?></li>
		</ul>
		<div>
			<ul class="list-inline list-unstyled navbar-footer">
				<li>Powered by <a href="http://www.erduo.in/" target="_blank"><strong>Ear Music</strong></a> <span title="<?php echo IN_BUILD; ?>"><?php echo IN_VERSION; ?></span> &copy; 2011-<?php echo date('Y'); ?> <a href="http://www.earcms.com/" target="_blank">Earcms</a> Inc.</li>
			</ul>
		</div>
	</div>
</div>
</body>
</html>