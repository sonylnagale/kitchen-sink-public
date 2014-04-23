<?php 
use Livefyre\Livefyre;

$network = Livefyre::getNetwork(LIVEFYRE_NETWORK, LIVEFYRE_NETWORK_SECRET);
echo $network->buildLivefyreToken();
?>
<h1>Home</h1>
