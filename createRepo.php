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
    
    $bare = ((isset ( $_POST ['bare'] ) && $_POST ['bare'] != "") ? 'Y' : '');
    
    echo "Creating new repo: " . $repo . "<br />";
    
    $repoPath = GitSettings::$_gitRepoPath . '/' . $repo;
    
    echo "\nRepo path: " . $repoPath . "<br />";
    
    if ($bare == 'Y') {
      echo "Bare Repo<br />";
    }
    
    $output = shell_exec ( 'scripts/git-init.sh ' . $repoPath . ' ' . $bare . ' 2>&1' );
    echo "\nInit Repo Result: $output <br />";
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
		</div>
		<button type="submit" form="form" class="btn btn-default" id="btn_submit">Submit</button>
	</form>
</body>
</html>
