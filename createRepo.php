<?php
include "gitManagerConfig.php";

function getQueryParam($paramName, $defaultVal) {
	$maxLen = 50;

	$retVal = ((isset ( $_POST [$paramName] ) && $_POST [$paramName] != "") ? $_POST [$paramName] : $defaultVal);

	if (strlen ( $retVal ) > $maxLen) {
		$retVal = substr ( $retVal, 0, $maxLen );
	}

	preg_replace ( "/[^A-Za-z0-9_-]/", '', $retVal );

	return $retVal;
}

function createRepo() {
  if ($_SERVER ['REQUEST_METHOD'] === 'POST') {
    $repo = getQueryParam ( "repo-name", null );

    if ($repo == null || $repo == "") {
      echo "Repo name not set";
      return;
    }

    $bare = ((isset ( $_POST ['bare'] ) && $_POST ['bare'] != "") ? 'Y' : 'N');
		$httpClone = ((isset ( $_POST ['http-clone'] ) && $_POST ['http-clone'] != "") ? 'Y' : 'N');

    echo "Creating new repo: " . $repo . "<br />";

    $repoPath = GitSettings::$_gitRepoPath . '/' . $repo;

    echo "\nRepo path: " . $repoPath . "<br />";

    if ($bare == 'Y') {
      echo "Bare Repo<br />";
    }

		if ($httpClone == 'Y') {
			echo "Http Clone Enabled<br />";
		}

		$cmd = 'scripts/git-init.sh ' . $repoPath . ' ' . $bare . ' ' . $httpClone . ' 2>&1';
		echo "Command: " . $cmd . "<hr />";
		$output = shell_exec ( $cmd );
		$htmlOutput = str_replace("\n", "\n<br />", $output);
    echo "Init Repo Result:<br /><br />$htmlOutput <br />";
    echo "<hr />";

	echo "Clone this Repo<br />";
	echo "git clone " . GitSettings::$_gitClonePrefix . $repoPath . "<br />";
	echo "<hr />";
  }
}

?>
<html>
<head>
<title>Create New Repo</title>
</head>
<body>
  <?php createRepo(); ?>
	<form id="form" action="createRepo.php" method="post">
		<div class="form-group">
			<label for="repo-name">New Repo:</label> <input type="text"
				class="form-control" name="repo-name" id="repo-name" maxLength="50" /><br />
      <input type="checkbox" name="bare" id="bare" checked="checked" />Bare<br />
			<input type="checkbox" name="http-clone" id="http-clone" checked="checked" />Http Clone Support<br />
		</div>
		<button type="submit" form="form" class="btn btn-default" id="btn_submit">Submit</button>
	</form>
</body>
</html>
