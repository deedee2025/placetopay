<?php

namespace deedee2025\PlaceToPay\Models;

class Forms {
	public static function PersonaForm( $peronaType ) {
		?>
		<tr>
			<td colspan="2">
				<h3>
					<?= $peronaType == 'payer' ? 'Pagador' : '' ?>
					<?= $peronaType == 'buyer' ? 'Comprador' : '' ?>
					<?= $peronaType == 'shipping' ? 'Receptor' : '' ?>
				</h3>
			</td>
		</tr>
		<tr>
			<td>
				<label for="<?= $peronaType ?>[document]">Documento:</label>
				<input type="text" id="<?= $peronaType ?>[document]" name="<?= $peronaType ?>[document]"
				       maxlength="12" />
			</td>
			<td>
				<label for="<?= $peronaType ?>[documentType]">Documento:</label>
				<select id="<?= $peronaType ?>[documentType]" name="<?= $peronaType ?>[documentType]">
					<option value="CC">Cédula de ciudanía colombiana</option>
					<option value="CE">Cédula de extranjería</option>
					<option value="TI">Tarjeta de identidad</option>
					<option value="PPN">Pasaporte</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<label for="<?= $peronaType ?>[firstName]">Nombres:</label>
				<input type="text" id="<?= $peronaType ?>[firstName]" name="<?= $peronaType ?>[firstName]"
				       maxlength="60" />
			</td>
			<td>
				<label for="<?= $peronaType ?>[lastName]">Apellidos:</label>
				<input type="text" id="<?= $peronaType ?>[lastName]" name="<?= $peronaType ?>[lastName]"
				       maxlength="60" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="<?= $peronaType ?>[company]">Empresa:</label>
				<input type="text" id="<?= $peronaType ?>[company]" name="<?= $peronaType ?>[company]" maxlength="60" />
			</td>
			<td>
				<label for="<?= $peronaType ?>[emailAddress]">Email:</label>
				<input type="email" id="<?= $peronaType ?>[emailAddress]" name="<?= $peronaType ?>[emailAddress]"
				       maxlength="80" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="<?= $peronaType ?>[address]">Dirección:</label>
				<input type="text" id="<?= $peronaType ?>[address]" name="<?= $peronaType ?>[address]"
				       maxlength="100" />
			</td>
			<td>
				<label for="<?= $peronaType ?>[city]">Ciudad:</label>
				<input type="text" id="<?= $peronaType ?>[city]" name="<?= $peronaType ?>[city]" maxlength="50" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="<?= $peronaType ?>[province]">Provincia/Departamento:</label>
				<input type="text" id="<?= $peronaType ?>[province]" name="<?= $peronaType ?>[province]"
				       maxlength="50" />
			</td>
			<td>
				<label for="<?= $peronaType ?>[country]">País
					<small>(ISO 3166-1)</small>
					:</label>
				<input type="text" id="<?= $peronaType ?>[country]" name="<?= $peronaType ?>[country]" maxlength="2"
				       value="CO" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="<?= $peronaType ?>[phone]">Teléfono:</label>
				<input type="text" id="<?= $peronaType ?>[phone]" name="<?= $peronaType ?>[phone]" maxlength="30" />
			</td>
			<td>
				<label for="<?= $peronaType ?>[mobile]">Teléfono Movil:</label>
				<input type="text" id="<?= $peronaType ?>[mobile]" name="<?= $peronaType ?>[mobile]" maxlength="30" />
			</td>
		</tr>
		<?php
	}

	public static function PSETansactionRequestForm( $banks, $url ) {
		if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		?>
		<form method="POST" action="<?= $url ?>">
			<table>
				<tr>
					<td>
						<label for="bankCode">Banco:</label>
						<select id="bankCode" name="bankCode">
							<?php foreach ( $banks as $bank ): ?>
								<option value="<?= $bank->bankCode ?>"><?= $bank->bankName ?></option>
							<?php endforeach; ?>
						</select>
					</td>
					<td>
						<label for="bankInterface">Interfaz:</label>
						<select id="bankInterface" name="bankInterface">
							<option value="0">Personas</option>
							<option value="1">Empresas</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label for="returnURL">URL de retorno:</label>
						<input type="text" id="returnURL" name="returnURL" />
					</td>
					<td>
						<label for="reference">Código de referencia:</label>
						<input type="text" id="reference" name="reference" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="description">Descripción:</label>
						<textarea id="description" name="description"></textarea>
					</td>
					<td>
						<label for="language">Idioma
							<small>(ISO 631-1)</small>
							:</label>
						<input type="text" id="language" name="language" value="ES" maxlength="2" minlength="2" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="currency">Moneda
							<small>(ISO 4217)</small>
							:</label>
						<input type="text" id="currency" name="currency" value="COP" maxlength="3" minlength="3" />
					</td>
					<td>
						<label for="totalAmount">Valor Total:</label>
						<input type="number" id="totalAmount" name="totalAmount" min="0" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="taxAmount">Valor Impuesto:</label>
						<input type="number" id="taxAmount" name="taxAmount" min="0" />
					</td>
					<td>
						<label for="devolutionBase">Base de devolución impuesto:</label>
						<input type="number" id="devolutionBase" name="devolutionBase" min="0" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="tipAmount">Valor Propina:</label>
						<input type="number" id="tipAmount" name="tipAmount" min="0" />
					</td>
					<td>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<hr />
					</td>
				</tr>
				<?php self::PersonaForm( 'payer' ) ?>
				<tr>
					<td colspan="2">
						<hr />
					</td>
				</tr>
				<?php self::PersonaForm( 'buyer' ) ?>
				<tr>
					<td colspan="2">
						<hr />
					</td>
				</tr>
				<?php self::PersonaForm( 'shipping' ) ?>
			</table>
			<input type="hidden" name="ipAddress" value="<?= $ip ?>">
			<input type="hidden" name="userAgent" value="<?= $_SERVER['HTTP_USER_AGENT'] ?>">
			<input type="hidden" name="additionalData" value="">
			<input type="submit" value="Enviar">
		</form>
		<?php
	}
}
