import React from 'react';
import {
    Box,
    Button,
    Heading,
    Table,
    Thead,
    Tbody,
    Tr,
    Th,
    Td,
    Badge,
    IconButton,
    useColorModeValue,
    HStack,
    VStack,
    Text,
    Select,
} from '@chakra-ui/react';
import { Plus, Edit, Eye, Phone, Mail } from 'lucide-react';

const MyLeads = () => {
    const bgColor = useColorModeValue('white', 'gray.800');

    const leads = [
        {
            id: 1,
            name: 'Amanda Wilson',
            email: 'amanda.w@email.com',
            phone: '+1 (555) 111-2222',
            source: 'Website',
            interest: 'Buying',
            budget: '$400K - $500K',
            status: 'new',
            date: '2025-11-18',
            lastContact: null,
        },
        {
            id: 2,
            name: 'Thomas Brown',
            email: 'thomas.b@email.com',
            phone: '+1 (555) 222-3333',
            source: 'Referral',
            interest: 'Selling',
            budget: '$600K - $700K',
            status: 'contacted',
            date: '2025-11-17',
            lastContact: '2025-11-17',
        },
        {
            id: 3,
            name: 'Patricia Garcia',
            email: 'patricia.g@email.com',
            phone: '+1 (555) 333-4444',
            source: 'Facebook',
            interest: 'Buying',
            budget: '$300K - $400K',
            status: 'qualified',
            date: '2025-11-16',
            lastContact: '2025-11-16',
        },
        {
            id: 4,
            name: 'Christopher Lee',
            email: 'chris.l@email.com',
            phone: '+1 (555) 444-5555',
            source: 'Google Ads',
            interest: 'Renting',
            budget: '$2K - $3K/mo',
            status: 'viewing_scheduled',
            date: '2025-11-15',
            lastContact: '2025-11-17',
        },
        {
            id: 5,
            name: 'Jennifer Martinez',
            email: 'jennifer.m@email.com',
            phone: '+1 (555) 777-8888',
            source: 'Walk-in',
            interest: 'Buying',
            budget: '$500K+',
            status: 'negotiating',
            date: '2025-11-10',
            lastContact: '2025-11-17',
        },
        {
            id: 6,
            name: 'Daniel Taylor',
            email: 'daniel.t@email.com',
            phone: '+1 (555) 888-9999',
            source: 'Website',
            interest: 'Selling',
            budget: '$450K - $550K',
            status: 'lost',
            date: '2025-11-05',
            lastContact: '2025-11-12',
        },
    ];

    const getStatusColor = (status) => {
        const colors = {
            new: 'purple',
            contacted: 'blue',
            qualified: 'green',
            viewing_scheduled: 'cyan',
            negotiating: 'orange',
            lost: 'red',
        };
        return colors[status] || 'gray';
    };

    return (
        <Box>
            <HStack justify="space-between" mb={8}>
                <Heading>My Leads</Heading>
                <HStack spacing={3}>
                    <Select placeholder="Filter by status" w="200px">
                        <option value="new">New</option>
                        <option value="contacted">Contacted</option>
                        <option value="qualified">Qualified</option>
                        <option value="viewing_scheduled">Viewing Scheduled</option>
                        <option value="negotiating">Negotiating</option>
                        <option value="lost">Lost</option>
                    </Select>
                    <Button leftIcon={<Plus size={20} />} colorScheme="blue">
                        Add Lead
                    </Button>
                </HStack>
            </HStack>

            <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                <Table variant="simple">
                    <Thead>
                        <Tr>
                            <Th>Lead</Th>
                            <Th>Contact</Th>
                            <Th>Source</Th>
                            <Th>Interest</Th>
                            <Th>Budget</Th>
                            <Th>Status</Th>
                            <Th>Last Contact</Th>
                            <Th>Actions</Th>
                        </Tr>
                    </Thead>
                    <Tbody>
                        {leads.map((lead) => (
                            <Tr key={lead.id}>
                                <Td fontWeight="semibold">{lead.name}</Td>
                                <Td>
                                    <VStack align="start" spacing={1}>
                                        <HStack spacing={2}>
                                            <Mail size={14} />
                                            <Text fontSize="sm">{lead.email}</Text>
                                        </HStack>
                                        <HStack spacing={2}>
                                            <Phone size={14} />
                                            <Text fontSize="sm">{lead.phone}</Text>
                                        </HStack>
                                    </VStack>
                                </Td>
                                <Td>
                                    <Badge>{lead.source}</Badge>
                                </Td>
                                <Td>{lead.interest}</Td>
                                <Td fontSize="sm">{lead.budget}</Td>
                                <Td>
                                    <Badge colorScheme={getStatusColor(lead.status)}>
                                        {lead.status.replace('_', ' ')}
                                    </Badge>
                                </Td>
                                <Td fontSize="sm">{lead.lastContact || 'Never'}</Td>
                                <Td>
                                    <HStack spacing={2}>
                                        <IconButton
                                            icon={<Eye size={16} />}
                                            size="sm"
                                            colorScheme="blue"
                                            variant="ghost"
                                            aria-label="View lead"
                                        />
                                        <IconButton
                                            icon={<Phone size={16} />}
                                            size="sm"
                                            colorScheme="green"
                                            variant="ghost"
                                            aria-label="Call lead"
                                        />
                                        <IconButton
                                            icon={<Mail size={16} />}
                                            size="sm"
                                            colorScheme="purple"
                                            variant="ghost"
                                            aria-label="Email lead"
                                        />
                                        <IconButton
                                            icon={<Edit size={16} />}
                                            size="sm"
                                            colorScheme="orange"
                                            variant="ghost"
                                            aria-label="Edit lead"
                                        />
                                    </HStack>
                                </Td>
                            </Tr>
                        ))}
                    </Tbody>
                </Table>
            </Box>
        </Box>
    );
};

export default MyLeads;
