#!/bin/sh
APISERVER=https://3D6F11FF935498CBA3E2D11FF8DA77F4.yl4.eu-west-2.eks.amazonaws.com && \
    NAMESPACE=fm && \
    DEPLOYMENT=nrna && \
curl --cacert $2 --header "Authorization: Bearer $1" --data '{"spec":{"template":{"metadata":{"annotations":{"kubectl.kubernetes.io/restartedAt":"'"$(date +%Y-%m-%dT%T%z)"'"}}}}}' -XPATCH   -H "Accept: application/json, */*" -H "Content-Type: application/strategic-merge-patch+json" ${APISERVER}/apis/apps/v1/namespaces/${NAMESPACE}/deployments/${DEPLOYMENT}
