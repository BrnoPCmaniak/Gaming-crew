			<div id="main">
			
				<div id="rightside">
				</div>
				
				<div id="content">
					<h1>Seznam členů webu Dino Space {letter}</h1>
					<!-- START members -->
					<p><strong><a href="profile/view/{ID}">{name}</a></strong></p>
					<p>Chová dinosaura <strong>{dino_breed}</strong> {dino_gender}ho pohlaví se jménem <strong>{dino_name}</strong></p>
					{form_relationship}
					<hr />
					<!-- END members -->
					<p>Zobrazena stránka {page_number} z {num_pages}</p>
					<p>{first} {previous} {next} {last}</p>
					<p>
						<a href="members/alpha/A/">A</a>
						<a href="members/alpha/B/">B</a>
						<a href="members/alpha/C/">C</a>
						<a href="members/alpha/D/">D</a>
						<a href="members/alpha/E/">E</a>
						<a href="members/alpha/F/">F</a>
						<a href="members/alpha/G/">G</a>
						<a href="members/alpha/H/">H</a>
						<a href="members/alpha/I/">I</a>
						<a href="members/alpha/J/">J</a>
						<a href="members/alpha/K/">K</a>
						<a href="members/alpha/L/">L</a>
						<a href="members/alpha/M/">M</a>
						<a href="members/alpha/N/">N</a>
						<a href="members/alpha/O/">O</a>
						<a href="members/alpha/P/">P</a>
						<a href="members/alpha/Q/">Q</a>
						<a href="members/alpha/R/">R</a>
						<a href="members/alpha/S/">S</a>
						<a href="members/alpha/T/">T</a>
						<a href="members/alpha/U/">U</a>
						<a href="members/alpha/V/">V</a>
						<a href="members/alpha/W/">W</a>
						<a href="members/alpha/X/">X</a>
						<a href="members/alpha/Y/">Y</a>
						<a href="members/alpha/Z/">Z</a>
					</p>
					<form action="members/search" method="post">
					<h2>Vyhledat člena</h2>
					<label for="name">Jméno</label><br />
					<input type="text" id="name" name="name" value="" /><br />
					<input type="submit" id="search" name="search" value="Vyhledat" />
					</form>
				</div>
			
			</div>