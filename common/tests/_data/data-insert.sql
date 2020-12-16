DELETE FROM user;

INSERT INTO user (username, auth_key, password_hash, email, status, created_at, updated_at, verification_token)
VALUES ('test_registo', 'Va34cAa9xrj8_BIyyiqSRXcwiesn0cmE', '$2y$13$SOZjs0AXo29YUeFhOdAxiuR.M/in3Ny6Ab90P8BdoZjhuCjG0ZOry',
'test_registo@live.com.pt', 10, 1391885313, 1391885313, 'TTySjXgsnPnX6Ps20jaDm9FKTvLz0eR7_1607525392');