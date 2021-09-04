# -*- mode: ruby -*-
# vi: set ft=ruby :

LOCAL_IP = "192.168.0.4"
HOST = "cc.local"
RAM = 1024
CPUS = 1

Vagrant.configure("2") do |config|
  config.vm.box = "damianlewis/ubuntu-18.04-lamp"
  
  config.vm.synced_folder "./", "/var/www/html", type: "nfs"
  
  # always use host timezone in VMs
  config.timezone.value = :host

  # always use Vagrants' insecure key
  config.ssh.insert_key = false
  config.ssh.forward_agent = true

  # automatically navigate to /var/www/html when running vagrant ssh
  config.ssh.extra_args = ["-t", "cd /var/www/html; bash --login"]
  
  config.vm.provider :virtualbox do |v|
    v.customize ["modifyvm", :id, "--ioapic", "on"]
    v.customize ["modifyvm", :id, "--paravirtprovider", "default"]
    v.customize ["modifyvm", :id, "--memory", RAM]
    v.customize ["modifyvm", :id, "--cpus", CPUS] 
    v.customize ["setextradata", :id, "VBoxInternal2/SharedFoldersEnableSymlinksCreate/var/www/html", "1"]
    v.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
    v.customize ["modifyvm", :id, "--natdnsproxy1", "on"]
  end
  
  # config.vm.network "private_network", type: "dhcp"
  config.vm.network "private_network", ip: LOCAL_IP
  config.vm.hostname = HOST
 
  # apt update and get
  config.vm.provision "shell" do |s|
    s.inline = <<-SHELL
      apt-key adv --keyserver keyserver.ubuntu.com --refresh-keys
      apt-get update
      apt-get -y install php7.4-gd php7.4-xml php7.4-mbstring php7.4-bcmath php7.4-zip php7.4-intl screen supervisor
    SHELL
  end
  # Set up and enable apache mod_rewrite
  
  config.vm.provision "shell" do |s|
    s.inline = <<-SHELL

      phpdismod xdebug
      phpenmod -v 7.4 bcmath
      a2enmod rewrite

      sudo update-alternatives --set php /usr/bin/php7.4
      sudo update-alternatives --set phar /usr/bin/phar7.4
      sudo update-alternatives --set phar.phar /usr/bin/phar.phar7.4

      sudo cp /vagrant/vagrant.apache.conf /etc/apache2/sites-available/
      
      a2dissite 000-default
      a2ensite vagrant.apache
      systemctl restart apache2
    SHELL
  end
 
  # Run composer on web root.
  
  config.vm.provision "shell",
    privileged: false,
    run: "always",
    inline: <<-SHELL
      export PATH="/home/vagrant/.nvm/versions/node/v8.12.0/bin:$PATH"

      cd /var/www/html

      echo "Composer"
      composer install

      echo "NPM"
      npm install --no-bin-links

      echo "Run"
      npm run dev
    SHELL
  
  config.hostmanager.enabled = true
  config.hostmanager.manage_host = true
  config.hostmanager.manage_guest = true
  config.hostmanager.ignore_private_ip = false
  
  config.trigger.after :up do |trigger|
    trigger.name = "Setup hosts file"
    trigger.run = {inline: "start http://#{HOST}"}
  end
end
