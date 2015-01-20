<?php 
require_once 'header.php'; // Haal functies op
bestelpagina();

echo'
<form action="add_to_cart.php" method="post">
	<table name="reserveren">
		<tr>
			<td>Naam</td>
			<td>
				<input required type="Text">
			</td>
		</tr>
		<tr>
			<td>E-mail</td>
			<td>
				<input required type="email">
			</td>
		</tr>
		<tr>
			<td>Tijd</td>
			<td>
				<select required name="tijd">
					<option value="16:00">16:00 - 18:00</option>
					<option value="16:30">16:30 - 18:30</option>
					<option value="17:00">17:00 - 19:00</option>
					<option value="17:30">17:30 - 19:30</option>
					<option value="18:00">18:00 - 20:00</option>
					<option value="18:30">18:30 - 20:30</option>
					<option value="19:00">19:00 - 21:00</option>
					<option value="19:30">19:30 - 21:30</option>
					<option value="20:00">20:00 - 22:00</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Aantal</td>
			<td>
				<input required type="number" range="10" min="4" max="50">
			</td>
		</tr>
			foreach($menunummer as $key => $value){
				<tr>
					<td>Menu' . $menunummer . '</td>
					<td>
						<input type="number" range="10" min="4" max="50">
					</td>
				</tr>
			}
	</table>
</form>

require_once "footer.php"
';
?>