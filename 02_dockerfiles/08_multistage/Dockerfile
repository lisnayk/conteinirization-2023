FROM node:20 as build
WORKDIR /app
COPY /app .
RUN npm install
RUN npm run build

FROM nginx:alpine as prod
COPY --from=build /app/dist /usr/share/nginx/html
EXPOSE 80
