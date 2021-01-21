<?php

foreach ($globals as $index => $define) {
		define($define,$$define);
}