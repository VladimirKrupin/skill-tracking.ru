#!/bin/bash
PURPLE='\033[0;35m'
GREEN='\033[0;32m'
NC='\033[0m' # No PURPLE
N='\n\n';
LINE="${GREEN}-------------------------------------${NC}";
RED='\033[0;31m';
cd /backend
printf "${RED}type vue build mode? [prod/dev]${NC}\n"
printf "${RED}выберите тип сборки приложения? [prod/dev]${NC}\n"
read -r -p "" response
case "$response" in
    "prod")
            npm run prod
        ;;
    "dev")
            npm run dev
        ;;
    *)
        exit 1
        ;;
esac