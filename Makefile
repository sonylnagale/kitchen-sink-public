install:
	@read -p "Who has the biggest office in the company? " keyphrase; \
	echo "OK, enter $$keyphrase when prompted for a password."; \
	gpg models/constants.js.gpg;