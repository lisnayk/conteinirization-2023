ARG NODE_VERSION=20
FROM node:${NODE_VERSION}
LABEL maintainer="A.Lisniak" version="0.0.1" description="This is entripoint example"
WORKDIR /app
COPY . /app
RUN npm install
ENV COLOR=red
EXPOSE 3000
ENTRYPOINT ["node","index.js"]
