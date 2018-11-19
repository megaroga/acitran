
<?php

/**
 * CRUD PDO PHPOO - Conexão e manipulação de Banco de Dados
 *
 * @author: Matheus Hentz
 */


class Conexao {
	public static $instance; //Guarda a conexão

	public static function getInstance() {
		if(!isset(self::$instance)) { //Verifica existe conexão
			self::$instance = new PDO('mysql:host=localhost;dbname=qs', 'root', 'rodolfo', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
		}

		return self::$instance; //Retorna conexão PDO;
	}

	/**
	 * Delete - Deleta dados do banco de dados
	 * $sql - Script sql de delete Ex.: DELETE FROM tabela WHERE campo1=:campo1
	 * $clausulas - Array com as clausulas WHERE Ex.: campo1 => valor1
	 * @return Linhas afetadas
	 */
	public static function delete($sql, $clausulas) {
		$conexao = self::getInstance()->prepare($sql);

		foreach($clausulas as $nome=>$valor) {
			$conexao->bindValue(":{$nome}", $valor);
		}
		$conexao->execute();
	}

	/**
	 * Update - Atualiza dados do banco de dados
	 * $sql - Script sql de update Ex.: UPDATE tabela SET campo1=:campo1, campo2=:campo2 WHERE campo3=:campo3
	 * $valores - Array com os valores a serem alterados + clausulas WHERE Ex.: campo1 => valor1, campo2 => valor2, campo3 => valor3
	 * @return Linhas afetadas
	 */
	public static function update($sql, $valores) {
		$conexao = self::getInstance()->prepare($sql);

		foreach($valores as $nome=>$valor) {
			$conexao->bindValue(":{$nome}", $valor);
		}
		return $conexao->execute();
	}

	/**
	 * Insert - Insere dados no banco de dados
	 * $sql - Script sql de insert Ex.: INSERT INTO tabela (campo1, campo2, campo3) VALUES (:campo1, :campo2, :campo3)
	 * $valores - Array com os valores a serem inseridos Ex.: campo1 => valor1, campo2 => valor2, campo3 => valor3
	 * @return auto increment da tabela
	 */
	public static function insert($sql, $valores) {
		$conexao = self::getInstance()->prepare($sql);

		foreach($valores as $nome=>$valor) {
			$conexao->bindValue(":{$nome}", $valor);
		}

		$conexao->execute();
		return self::getInstance()->lastInsertId();
	}

	/**
	 * fetch - Seleciona uma linha no banco de dados de uma tabela
	 * $sql - Script sql de select Ex.: SELECT * FROM tabela WHERE campo1=:campo1
	 * $clausulas - Array com os valores a serem inseridos Ex.: campo1 => valor1
	 * @return stdClass
	 */
	public static function fetch($sql, $clausulas = null) {
		$conexao = self::getInstance()->prepare($sql);

		if(!empty($clausulas)) {
			foreach($clausulas as $nome=>$clausula) {
				$conexao->bindValue(":{$nome}", (!empty($clausula) ? $clausula : null));
			}
		}

		$conexao->execute();
		return $conexao->fetch(PDO::FETCH_OBJ);
	}

	/**
	 * fetchAll - Seleciona todos os dados, dentro dos limites e filtros expecificados de uma tabela
	 * $sql - Script sql de select Ex.: SELECT * FROM tabela WHERE campo1=:campo1 LIMIT :offset,:limit
	 * $clausulas - Array com os valores a serem inseridos Ex.: campo1 => valor1, offset => valor2, limit => valor3
	 * @return array
	 */
	public static function fetchAll($sql, $clausulas = null) {
		$conexao = self::getInstance()->prepare($sql);

		if(!empty($clausulas)) {
			foreach($clausulas as $nome=>$clausula) {
				$conexao->bindValue(":{$nome}", $clausula);
			}
		}

		$conexao->execute();
		return $conexao->fetchAll(PDO::FETCH_OBJ);
	}

	/**
	 * numRows - Conta todas as linhas, dentro dos limites e filtros expecificados de uma tabela
	 * $sql - Script sql de select Ex.: SELECT * FROM tabela WHERE campo1=:campo1 LIMIT :offset,:limit
	 * $clausulas - Array com os valores a serem inseridos Ex.: campo1 => valor1, offset => valor2, limit => valor3
	 * @return array
	 */
	public static function numRows($sql, $clausulas = null) {
		$conexao = self::getInstance()->prepare($sql);

		if(!empty($clausulas)) {
			foreach($clausulas as $nome=>$clausula) {
				$conexao->bindValue(":{$nome}", $clausula);
			}
		}

		$conexao->execute();
		return $conexao->rowCount();
	}

	public static function replaceColumn($campo) {
		$caracters =			array(" ", "<", ">", "{", "}", "[", "]", "(", ")", "/", "~", "^", ";", ":", "!", "@", "#", "$", "%", "¨", "&", "*", "§", "+", "=", "www.", "www", ".com", ".br", "?", ",", "|", "´", "°", "ª", "º", "á", "à", "ã", "â", "ä", "é", "ë", "è", "ê", "í", "ì", "î", "ï", "ó", "ò", "õ", "ô", "ö", "ç", "ú", "ù", "û", "ü");
		$substitui_caracters =	array("-", "",  "",  "",  "",  "",  "",  "",  "",  "",  "",  "",  "",  "",  "",  "",  "",  "",  "",  "",  "",  "",  "",  "",  "",  "",     "",    "",     "",    "",  "",  "",  "",  "",  "",  "",  "a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "c", "u", "u", "u", "u");

		foreach($caracters as $chave => $caracter) {
			$replace = "replace(" .(isset($replace) ? $replace : "lower(" .$campo. ")"). ", '$caracter', '".$substitui_caracters[$chave]."')";
		}

		return $replace;
	}
}