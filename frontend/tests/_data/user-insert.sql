DELETE FROM user;

INSERT INTO user (username, auth_key, password_hash, email, status, created_at, updated_at, verification_token)
VALUES ('test_registo', 'Va34cAa9xrj8_BIyyiqSRXcwiesn0cmE', '$2y$13$SOZjs0AXo29YUeFhOdAxiuR.M/in3Ny6Ab90P8BdoZjhuCjG0ZOry',
'test_registo@live.com.pt', 10, 1391885313, 1391885313, 'TTySjXgsnPnX6Ps20jaDm9FKTvLz0eR7_1607525392');

DELETE FROM userprofile;

INSERT INTO userprofile (primeiroNome, ultimoNome, dtaNascimento, morada, localidade, distrito, sexo, id_user_rbac)
VALUES ('Teste', 'Teste', '20-03-2000', 'Rua A', 'Leiria', 'Leiria', 'Masculino', 1);

DELETE FROM estiloconstrucao;

INSERT INTO estiloconstrucao (descricao)
VALUES ('Barroco');

DELETE FROM tipomonumento;

INSERT INTO tipomonumento (descricao)
VALUES ('Castelo');

DELETE FROM localidade;

INSERT INTO localidade (nomeLocalidade, foto)
VALUES ('Leiria', 'castelo-leiria-jpg');

DELETE FROM pontosturisticos;

INSERT INTO pontosturisticos (nome, anoConstrucao, descricao, foto, tm_idTipoMonumento , ec_idEstiloConstrucao , localidade_idLocalidade)
VALUES ('Teste', '1135', 'Em Leiria', 'castelo-leiria-jpg', (SELECT idEstiloConstrucao FROM estiloconstrucao WHERE descricao = "Barroco"),
(SELECT idTipoMonumento FROM tipomonumento WHERE descricao = "Castelo"), (SELECT id_localidade FROM localidade WHERE nomeLocalidade = "Leiria"));