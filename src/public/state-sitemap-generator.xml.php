<?php
/**
  *
  * This is a quick way to turn a simple text file
  * with a list of urls in a text file (sitemap-urls.txt)
  * into a valid XML Sitemap:
  * http://en.wikipedia.org/wiki/Sitemaps
  * Put this file sitemap.xml.php and sitemap-urls.txt at
  * the webroot http://example.com/sitemap.xml.php
  * Then add the text in quotes below to your robots.txt file as a new line:
  * "Sitemap: http://example.com/sitemap.xml.php"
  * Questions? email joe@artlung.com
  */
$filename = 'facilities.txt';
$urls = file($filename);
$filectime = filectime($filename);
$urls = array_map('trim',$urls);
$sitemap = array();
foreach($urls as $url) {
	if ($url != '') {
		$priority = '0.5';
		$sitemap[] = array(
			'loc' => $url,
			'lastmod' => date('Y-m-d',$filectime),
			'changefreq' => 'weekly',
			'priority' => $priority,
		);
	}
}
header('Content-Type: text/xml');
echo '<?xml version=\'1.0\' encoding=\'UTF-8\'?>';
echo "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
			    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
echo "\n";
foreach ($sitemap as $link) {
	echo "\t<url>\n";
	echo "\t\t<loc>" . htmlentities($link['loc']) . "</loc>\n";
	echo "\t\t<lastmod>{$link['lastmod']}</lastmod>\n";
	echo "\t\t<changefreq>{$link['changefreq']}</changefreq>\n";
	echo "\t\t<priority>{$link['priority']}</priority>\n";
	echo "\t</url>\n";
}
echo '</urlset>';
?>
