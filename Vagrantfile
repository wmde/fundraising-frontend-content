Vagrant.configure(2) do |config|
	config.vm.box = "ubuntu/xenial64"

	config.vm.network "private_network", ip: "192.168.66.77"

	config.vm.provider "virtualbox" do |vb|
	 vb.memory = "1024"
	end

	config.vm.provision "shell", inline: <<-SHELL
		set -x

		add-apt-repository ppa:ondrej/php -y
		apt-get update

		apt-get install -y php7.1 php7.1-xml php7.1-zip php7.1-mbstring
	SHELL

	config.vm.provision "shell", inline: <<-SHELL
		set -x

		EXPECTED_SIGNATURE=$(wget -q -O - https://composer.github.io/installer.sig)
		php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
		ACTUAL_SIGNATURE=$(php -r "echo hash_file('SHA384', 'composer-setup.php');")

		if [ "$EXPECTED_SIGNATURE" != "$ACTUAL_SIGNATURE" ]
		then
			>&2 echo 'ERROR: Invalid installer signature'
			rm composer-setup.php
			exit 1
		fi

		php composer-setup.php --quiet
		RESULT=$?

		mv composer.phar /usr/local/bin/composer

		rm composer-setup.php
	SHELL

	config.vm.provision "shell", privileged: false, inline: <<-SHELL
		set -x
		cd /vagrant
		composer install --no-interaction
	SHELL

end
