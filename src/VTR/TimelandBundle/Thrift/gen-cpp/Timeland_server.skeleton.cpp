// This autogenerated skeleton file illustrates how to build a server.
// You should copy it to another filename to avoid overwriting it.

#include "Timeland.h"
#include <thrift/protocol/TBinaryProtocol.h>
#include <thrift/server/TSimpleServer.h>
#include <thrift/transport/TServerSocket.h>
#include <thrift/transport/TBufferTransports.h>

using namespace ::apache::thrift;
using namespace ::apache::thrift::protocol;
using namespace ::apache::thrift::transport;
using namespace ::apache::thrift::server;

using boost::shared_ptr;

using namespace  ::timeland_thrift;

class TimelandHandler : virtual public TimelandIf {
 public:
  TimelandHandler() {
    // Your initialization goes here
  }

  void compute(std::string& _return, const std::string& file) {
    // Your implementation goes here
    printf("compute\n");
  }

};

int main(int argc, char **argv) {
  int port = 9090;
  shared_ptr<TimelandHandler> handler(new TimelandHandler());
  shared_ptr<TProcessor> processor(new TimelandProcessor(handler));
  shared_ptr<TServerTransport> serverTransport(new TServerSocket(port));
  shared_ptr<TTransportFactory> transportFactory(new TBufferedTransportFactory());
  shared_ptr<TProtocolFactory> protocolFactory(new TBinaryProtocolFactory());

  TSimpleServer server(processor, serverTransport, transportFactory, protocolFactory);
  server.serve();
  return 0;
}

