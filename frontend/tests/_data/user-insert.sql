DELETE FROM user;

INSERT INTO user (username, auth_key, password_hash, email, status, created_at, updated_at, verification_token)
VALUES ('test_registo', 'Va34cAa9xrj8_BIyyiqSRXcwiesn0cmE', '$2y$13$SOZjs0AXo29YUeFhOdAxiuR.M/in3Ny6Ab90P8BdoZjhuCjG0ZOry',
'test_registo@live.com.pt', 10, 1391885313, 1391885313, 'TTySjXgsnPnX6Ps20jaDm9FKTvLz0eR7_1607525392');

DELETE FROM auth_assignment;

INSERT INTO auth_assignment (item_name, user_id)
VALUE ('admin', (SELECT id FROM user WHERE username LIKE 'test_registo'));

DELETE FROM userprofile;

INSERT INTO userprofile (primeiroNome, ultimoNome, dtaNascimento, morada, localidade, distrito, sexo, id_user_rbac)
VALUES ('Teste', 'Userprofile', '2010-11-02', 'ESTG', 'Leiria', 'Leiria', 'Masculino', (SELECT id FROM user WHERE username LIKE 'test_registo'));

DELETE  FROM favoritos;

DELETE FROM estiloconstrucao;

INSERT INTO estiloconstrucao (descricao)
VALUES ('Barroco');

DELETE FROM tipomonumento;

INSERT INTO tipomonumento (descricao)
VALUES ('Castelo');

DELETE FROM localidade;

INSERT INTO localidade (nomeLocalidade, foto)
VALUES ('Leiria', 'castelo-leiria.jpg');

DELETE FROM pontosturisticos;

INSERT INTO pontosturisticos (nome, anoConstrucao, descricao, foto, tm_idTipoMonumento , ec_idEstiloConstrucao , localidade_idLocalidade, horario, morada, telefone, status, latitude, longitude)
VALUES ('Teste', '2020', 'Isto é um Teste', 'teste.jpg', (SELECT idTipoMonumento FROM tipomonumento WHERE descricao LIKE 'Castelo'), (SELECT idEstiloConstrucao FROM estiloconstrucao WHERE descricao LIKE 'Barroco'),
(SELECT id_localidade FROM localidade WHERE nomeLocalidade LIKE 'Leiria'),'8:00h - 17:00h', 'Rua de Teste', '987456321', 1, '39.74362', '-8.80705');