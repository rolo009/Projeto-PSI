
DELETE FROM estiloconstrucao;

INSERT INTO estiloconstrucao (descricao)
VALUES ('Barroco');

DELETE FROM tipomonumento;

INSERT INTO tipomonumento (descricao)
VALUES ('Castelo');

DELETE FROM localidade;

INSERT INTO localidade (nomeLocalidade, foto)
VALUES ('Leiria', 'castelo-leiria-jpg');

DELETE FROM contactos;

INSERT INTO contactos (nome, email,	assunto, mensagem, status)
VALUES ('Teste', 'teste_contactos@gmail.com', 'Testar Contactos', 'Isto é um teste!', 0)