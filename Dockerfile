FROM keboola/docker-amazonlinux-php:latest

# install node, yarn and composer
RUN curl --silent --location https://rpm.nodesource.com/setup_12.x | bash -
RUN curl --silent https://dl.yarnpkg.com/rpm/yarn.repo > /etc/yum.repos.d/yarn.repo
RUN yum -y install findutils nodejs npm yarn python27 wget
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

# working directory
WORKDIR /var/task
COPY . .

# install composer dependencies
RUN composer install

# install serverless
RUN yarn global add serverless@1.57
