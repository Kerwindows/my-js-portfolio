<?php
/**
 * Class and Function List:
 * Function list:
 * - asideNav()
 * - dropdownLevel1()
 * - dropdownLevel2()
 * - array_depth()
 * Classes list:
 * - Asides
 */
class Aside {

	//EXPLANATION: navFunction( link, title , font-awesome icon class , badge class (optional), badge contents(optional), extra classes(optional) );
	public function asideNav($slug = "#", $nav_title = 'Title', $nav_icon = 'fas fa-tachometer-alt', $badge = 'badge-danger', $bagde_contents = null, $extra_classes = null) {

		$active = "";
		$slug_check = $slug;

		//check and remove & if found in the url. Aparently the active nav doest work when & is in the url
		if (strpos($slug, "&")) {
			$slug_check = substr($slug, 0, strpos($slug, '&'));
		}

		if (isset($_GET[$slug_check])) {
			$active = "active";
		}
		echo "<li class='nav-item'>
			   <a id='$slug_check' href='?$slug' class='nav-link $extra_classes $active'>
			      <i class='nav-icon $nav_icon'></i>
			      <p>$nav_title <span class='right badge $badge'>$bagde_contents</span></p>
			   </a>
			</li>";
	}

	public function dropdownLevel1($dropdownArray, $dropdownTitle, $dropdownIcon) {

		$id2 = rand();
		$id3 = rand();

		print " <li id='$id2' class='nav-item'>
			  <a href='#' id='$id3' class='nav-link'>
			    <i class='nav-icon $dropdownIcon'></i>
			     <p>$dropdownTitle<i class='nav-icon right fas fa-angle-left'></i></p>
			  </a>
         		  <ul class='nav nav-treeview'>";

		foreach ($dropdownArray as $a) {

			if (empty($a[0])) {
				$a[0] = "#";
			}
			if (empty($a[1])) {
				$a[1] = 'Title';
			}
			if (empty($a[2])) {
				$a[2] = 'fas fa-tachometer-alt';
			}
			if (empty($a[3])) {
				$a[3] = 'badge-danger';
			}
			if (empty($a[4])) {
				$a[4] = null;
			}
			if (empty($a[5])) {
				$a[5] = null;
			}

			if (strpos($a[0], "&")) {

				$a_slug = substr($a[0], 0, strpos($a[0], '&'));
			}
			else {
				$a_slug = $a[0];
			}

			if (isset($_GET[$a_slug])) {

				print "<script>$('#$id2').addClass('menu-open') </script>";
				print "<script>$('#$id3').addClass('active') </script>";

				$active = "active";
			}
			else {
				$active = "";
			}

			print "<li class='nav-item'>
		   		<a href='?{$a[0]}' class='nav-link {$a[5]} $active'>
		     		 <i class='nav-icon {$a[2]}'></i>
		      		<p>{$a[1]}<span class='right badge {$a[3]}'>$a[4]</span></p>
		   		</a>
			      </li>";
		}
		print "</ul></li>";

	}
	public function dropdownLevel2($dropdownArray, $dropdownTitle2, $dropdownIcon2, $dropdownTitle, $dropdownIcon) {

		$id2 = rand();
		$id3 = rand();
		$id4 = rand();
		$id5 = rand();

		print " <li id='$id4' class='nav-item first-open'>
			  <a href='#' id='$id5' class='nav-link first-active'>
			    <i class='nav-icon $dropdownIcon2'></i>
			     <p>$dropdownTitle2<i class='nav-icon right fas fa-angle-left'></i></p>
			  </a>
         		  <ul class='nav nav-treeview'>";

		foreach ($dropdownArray as $a) {

			if ($this->array_depth($a) == 2) {
				echo "<li id='$id2' class='nav-item second-open'>
			  <a href='#' id='$id3' class='nav-link second-active'>
			    <i class='nav-icon $dropdownIcon'></i>
			     <p>$dropdownTitle<i class='nav-icon right fas fa-angle-left'></i></p>
			  </a>
			  <ul class='nav nav-treeview'>";

				for ($x = 0;$x < count($a);$x++) {

					if (empty($a[$x][0])) {
						$a[$x][0] = "#";
					}
					if (empty($a[$x][1])) {
						$a[$x][1] = 'Title';
					}
					if (empty($a[$x][2])) {
						$a[$x][2] = 'fas fa-tachometer-alt';
					}
					if (empty($a[$x][3])) {
						$a[$x][3] = 'badge-danger';
					}
					if (empty($a[$x][4])) {
						$a[$x][4] = null;
					}
					if (empty($a[$x][5])) {
						$a[$x][5] = null;
					}

					if (strpos($a[$x][0], "&")) {

						$a_slug = substr($a[$x][0], 0, strpos($a[$x][0], '&'));
					}
					else {
						$a_slug = $a[$x][0];
					}

					if (isset($_GET[$a_slug])) {

						print "<script>$('#$id2').addClass('menu-open');</script>";
						print "<script>$('#$id4').addClass('menu-open');</script>";
						print "<script>$('#$id3').addClass('active');</script>";
						print "<script>$('#$id5').addClass('active');</script>";

						$active = "active";
					}
					else {
						$active = "";
					}

					print "<li class='nav-item'>
			   		<a href='?{$a[$x][0]}' class='nav-link {$a[$x][5]} $active'>
			     		 <i class='nav-icon {$a[$x][2]}'></i>
			      		<p>" . $a[$x][1] . "<span class='right badge " . $a[$x][3] . "'>" . $a[$x][4] . "</span></p>
			   		</a>
				      </li>";
				}
			}
			else {
				if (empty($a[0])) {
					$a[0] = "#";
				}
				if (empty($a[1])) {
					$a[1] = 'Title';
				}
				if (empty($a[2])) {
					$a[2] = 'fas fa-tachometer-alt';
				}
				if (empty($a[3])) {
					$a[3] = 'badge-danger';
				}
				if (empty($a[4])) {
					$a[4] = null;
				}
				if (empty($a[5])) {
					$a[5] = null;
				}

				if (strpos($a[0], "&")) {

					$a_slug = substr($a[0], 0, strpos($a[0], '&'));
				}
				else {
					$a_slug = $a[0];
				}

				if (isset($_GET[$a_slug])) {

					print "<script>$('#$id2').addClass('menu-open');$('#$id4').addClass('menu-open');  </script>";
					print "<script>$('#$id3').addClass('active'); $('#$id5').addClass('active');</script>";

					$active = "active";
				}
				else {
					$active = "";
				}

				print "<li class='nav-item'>
			   		<a href='?{$a[0]}' class='nav-link {$a[5]} $active'>
			     		 <i class='nav-icon {$a[2]}'></i>
			      		<p>{$a[1]}<span class='right badge {$a[3]}'>$a[4]</span></p>
			   		</a>
				      </li>";
			}
		}

		print "</ul></li></ul></li>";

	}

	//checks
	public function array_depth($array) {
		$max_indentation = 1;

		$array_str = print_r($array, true);
		$lines = explode("\n", $array_str);

		foreach ($lines as $line) {
			$indentation = (strlen($line) - strlen(ltrim($line))) / 4;

			if ($indentation > $max_indentation) {
				$max_indentation = $indentation;
			}
		}

		return ceil(($max_indentation - 1) / 2) + 1;
	}

}