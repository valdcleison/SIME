CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_escola_create`(

)
BEGIN
	
    DECLARE vidpessoa INT;
    DECLARE videndereco INT;
    DECLARE vidcontato INT;
    DECLARE vidusuario INT;
    
    INSERT INTO pessoa (nomepessoa, cpfpessoa) VALUES (pnomepessoa, pcpfpessoa);
    
    SET vidpessoa = LAST_INSERT_ID();
    
    INSERT INTO usuario (emailpessoa, usuario, senha, niveladmin, idpessoa) VALUES (pemailpessoa, pusuario, psenha, '1', vidpessoa);
    
    SET vidusuario = LAST_INSERT_ID();
    
    INSERT INTO endereco (rua, numero, bairro, cidade, estado, cep) VALUES ();
    
    SET videndereco = LAST_INSERT_ID();
    
    INSERT INTO contato (telefone, celular, email) VALUES ();
    
    SET vidcontato = LAST_INSERT_ID();
    
	INSERT INTO escola 	(nomeescola, cnpj, nomegestor) VALUES (); 
		
    
    SELECT * FROM usuario a INNER JOIN pessoa b USING(idpessoa) WHERE a.niveladmin = 2 ORDER BY b.nomepessoa;

END