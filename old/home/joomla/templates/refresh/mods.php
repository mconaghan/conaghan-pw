<?php
if($this->countModules('left and right') == 0) $contentwidth = "100";
if($this->countModules('left or right') == 1) $contentwidth = "75";
if($this->countModules('left and right') == 1) $contentwidth = "50";

if($this->countModules('above1 or above2 or above3') == 1) $abovewidth = "-100";
if($this->countModules('above1 and above2') >= 1) $abovewidth = "-50";
if($this->countModules('above2 and above3') >= 1) $abovewidth = "-50";
if($this->countModules('above1 and above3') >= 1) $abovewidth = "-50";
if($this->countModules('above1 and above2 and above3') >= 1) $abovewidth = "-33";

if($this->countModules('user1') == 0) $modwidth = "100"; 
if($this->countModules('user2') == 0) $modwidth = "100";
if($this->countModules('user1 and user2') >= 1) $modwidth = "50";

if($this->countModules('user3 or user4 or user5') == 1) $userwidth = "-100";
if($this->countModules('user3 and user4') >= 1) $userwidth = "-50";
if($this->countModules('user4 and user5') >= 1) $userwidth = "-50";
if($this->countModules('user3 and user5') >= 1) $userwidth = "-50";
if($this->countModules('user3 and user4 and user5') >= 1) $userwidth = "-33";

?>
 

