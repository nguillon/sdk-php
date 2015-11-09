VERSION=$(grep "version" composer.json | cut -d":" -f2 | awk -F '"' '{print $2}') # Get version from composer.json
BASEDIR=$(dirname $0)

if [ ! -d $BASEDIR/swagger-codegen ]; then
  echo "Cloning swagger-codegen..."
  git clone https://github.com/swagger-api/swagger-codegen $BASEDIR/swagger-codegen
fi

cd $BASEDIR/swagger-codegen

if [ ! -f modules/swagger-codegen-cli/target/swagger-codegen-cli.jar ]; then
  echo "Creating package..."
  ./run-in-docker.sh mvn package
fi

echo "Deleting current lib directory..."
rm -rf ../../lib

echo "Building SDK for version "$VERSION"..."
cp ../config.json .
curl https://console.xtractor.io/scheme/api/$VERSION.json > spec.json
./run-in-docker.sh generate \
  -i spec.json \
  -l php \
  -c config.json

echo "Copying new lib directory..."
cp -pr SwaggerClient-php/lib ../../

echo "Completed."
