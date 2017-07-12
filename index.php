<?php
include "gitManagerConfig.php";
?>
<!DOCTYPE html>
<html>
<head>
<title>Bare Git Manager</title>
</head>
<body>
  <h1>Bare Git Manager</h1><br />
  <a href="createRepo.php">Create a new Repo</a><br />
  <hr />
  <br />
<?php echo "<b>Local Git Path:</b> " . GitSettings::$_gitRepoPath . "<br />"; ?>
  <br />
  <b>Current Repos</b>
  <ul>
<?php
$dir = new DirectoryIterator(GitSettings::$_gitRepoPath);
foreach ($dir as $fileinfo) {
    if ($fileinfo->isDir() && !$fileinfo->isDot()) {
        echo '<li>'.$fileinfo->getFilename().'</li>';
        
        $repoPath = GitSettings::$_gitRepoPath . '/' . $fileinfo->getFilename();
        echo "git clone " . GitSettings::$_gitClonePrefix . $repoPath . "<br />";
        echo "<br />";
    }
}
?>
  </ul>
</body>
</html>
