# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  # All Vagrant configuration is done here. The most common configuration
  # options are documented and commented below. For a complete reference,
  # please see the online documentation at vagrantup.com.

  # Every Vagrant virtual environment requires a box to build off of.
  config.vm.box = "ubuntu/trusty64"


  config.vm.provision :shell, path: "bootstrap.sh"
  config.vm.network :forwarded_port, host: 8080, guest: 80

  # set application folder to be apache writable
  config.vm.synced_folder "app", "/vagrant/app", id: "vagrant-app",
    owner: "vagrant",
    group: "www-data",
    mount_options: ["dmode=777,fmode=777"]

  config.vm.synced_folder "web", "/vagrant/web", id: "vagrant-web",
    owner: "vagrant",
    group: "www-data",
    mount_options: ["dmode=777,fmode=777"]

  config.vm.provider "virtualbox" do |vb|
    vb.memory = 2048
    vb.cpus = 1
  end
end
